<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseSection;
use App\Models\CourseLecture;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\Orderconfirm;
use Stripe;
use App\Models\User;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Notification;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){

        $course = Course::find($id);

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        // Check if the course is already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if ($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is already in your cart']);
        }

        if ($course->discount_price == NULL) {

            Cart::add([
                'id' => $id, 
                'name' => $request->course_name, 
                'qty' => 1, 
                'price' => $course->selling_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]); 

        }else{

            Cart::add([
                'id' => $id, 
                'name' => $request->course_name, 
                'qty' => 1, 
                'price' => $course->discount_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);  
        }

        return response()->json(['success' => 'Successfully Added on Your Cart']); 

    }

    public function CartData(){

        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));

    }

    public function AddMiniCart(){

        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));

    }

    public function RemoveMiniCart($rowId){

        Cart::remove($rowId);
        return response()->json(['success' => 'Course Remove From Cart']);

    }

    public function MyCart(){

        return view('frontend.mycart.view_mycart');

    } // End Method 

    public function GetCartCourse(){

        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));

    }

    public function CartRemove($rowId){

        Cart::remove($rowId);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
 
            Session::put('coupon',[
             'coupon_name' => $coupon->coupon_name,
             'coupon_discount' => $coupon->coupon_discount,
             'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
             'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
         ]);
 
         }

        return response()->json(['success' => 'Course Remove From Cart']);

    }


    public function CouponApply(Request $request){
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first(); 

        if ($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));

        }else {
            return response()->json(['error' => 'Invaild Coupon']);
        }
    }


    public function CouponCalculation(){

        if (Session::has('coupon')) {
           return response()->json(array(
            'subtotal' => Cart::total(),
            'coupon_name' => session()->get('coupon')['coupon_name'],
            'coupon_discount' => session()->get('coupon')['coupon_discount'],
            'discount_amount' => session()->get('coupon')['discount_amount'],
            'total_amount' => session()->get('coupon')['total_amount'],
           ));
        } else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }

    }

    public function CouponRemove(){

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);

    }// End Method 

    public function CheckoutCreate(){

        if (Auth::check()) {

            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartTotal = Cart::total();
                $cartQty = Cart::count();

                return view('frontend.checkout.checkout_view',compact('carts','cartTotal','cartQty'));
            } else{

                $notification = array(
                    'message' => 'Cart is Empty',
                    'alert-type' => 'error'
                );
                return redirect()->to('/')->with($notification); 

            }

        }else{

            $notification = array(
                'message' => 'Please Login First',
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notification); 

        }

    }

    public function Payment(Request $request){

        

        // Check if a coupon is applied
        if (Session::has('coupon')) {
            // Get the total amount after applying the coupon
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            // Calculate the total amount from the cart if no coupon applied
            $total_amount = round(Cart::total());
        }
        // Create a new Payment record
        $data = new Payment();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->cash_delivery = $request->cash_delivery;
        $data->total_amount = $total_amount;
        $data->payment_type = 'Direct Payment';
        $data->invoice_no = 'EOS' . mt_rand(10000000, 99999999);
        $data->order_date = Carbon::now()->format('d F Y');
        $data->order_month = Carbon::now()->format('F');
        $data->order_year = Carbon::now()->format('Y');
        $data->status = 'pending';
        $data->created_at = Carbon::now(); 
        $cartTotal = Cart::total();
            $carts = Cart::content();

        $validOrders = [];

    foreach ($request->course_title as $key => $course_title) {
    // Check if the user has already enrolled in the course
    $existingOrder = Order::where('user_id', Auth::user()->id)
                          ->where('course_id', $request->course_id[$key])
                          ->first();

    if ($existingOrder) {
        // Redirect back with an error message if the user is already enrolled
        $notification = [
            'message' => $existingOrder->course_title . '<br/> >>> Already Enrolled <<<' ,
            'alert-type' => 'error'
        ];
        return redirect()->back()->with($notification); 
    } 
    // Create a new Order record
    $order = new Order();
    $order->payment_id = 0;
    $order->user_id = Auth::user()->id;
    $order->course_id = $request->course_id[$key];
    $order->instructor_id = $request->instructor_id[$key];
    $order->course_title = $course_title;
    $order->price = $request->price[$key];
    // Add the order to the validOrders array
    $validOrders[] = $order;
    }
                    
    
        // Redirect based on the payment method chosen
        if ($request->cash_delivery == 'stripe') {
            
            return view('frontend.payment.stripe',compact('data','cartTotal','carts','validOrders'));

            /*   $notification = array(
                'message' => 'Stripe Payment Failed',
                'alert-type' => 'error'
            );
            return redirect()->route('index')->with($notification); 
            $request->session()->forget('cart'); */
            // Payment method is Stripe
            /* echo "stripe"; // Placeholder for Stripe payment process */




        } else {
            
            // Clear the cart session after successful payment
            $request->session()->forget('cart');
            // Save all valid orders
            $data->save();
            $paymentId = $data->id;
            foreach ($validOrders as $order) {
                $order->payment_id = $paymentId;
                $order->save();
            }

            /// Start Send email to student ///
           $sendmail = Payment::find($paymentId);
           $data = [
                'invoice_no' => $sendmail->invoice_no,
                'amount' => $total_amount,
                'name' => $sendmail->name,
                'email' => $sendmail->email,
           ];

           Mail::to($request->email)->send(new Orderconfirm($data));
           
           /// Send Notification 
           $user = User::where('role','instructor')->get();
           Notification::send($user, new OrderComplete($request->name));
           
            // Payment method is cash on delivery
            $notification = array(
                'message' => 'Cash payment submitted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('index')->with($notification); 
        }  
    }

    public function BuyToCart(Request $request, $id){

        $course = Course::find($id); 

        // Check if the course is already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if ($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is already in your cart']);
        }

        if ($course->discount_price == NULL) {

            Cart::add([
                'id' => $id, 
                'name' => $request->course_name, 
                'qty' => 1, 
                'price' => $course->selling_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]); 

        }else{

            Cart::add([
                'id' => $id, 
                'name' => $request->course_name, 
                'qty' => 1, 
                'price' => $course->discount_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);  
        }

        return response()->json(['success' => 'Successfully Added on Your Cart']); 

    }

    public function StripeOrder(Request $request){

        $invoiceNum = 'EOS' . mt_rand(10000000, 99999999);

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
         }else {
             $total_amount = round(Cart::total());
         }

         $order_id = Payment::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_amount' => $total_amount,
            'payment_type' => 'Stripe',
            'invoice_no' =>  $invoiceNum,
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(), 

         ]);

         $order = Payment::find($order_id);

         \Stripe\Stripe::setApiKey('sk_test_51OlSYNI7nYsKa9PLvc2DgKekEweRhaIAPHOZFyPWwG5GgBx3P90DzDiq2mmJtJWcBCB1eTAhjeDp09EtIYNFsCVf00LYaMN47y');

         $token = $_POST['stripeToken'];

         try{

         $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100, 
            'currency' => 'usd',
            'description' => 'Mydemy - Invoice : ' . $invoiceNum,
            'source' => $token,
            'metadata' => ['order_id' => '3434'],
         ]);

        }catch (\Stripe\Exception\CardException $e) {
            // The card has been declined
            // You can handle this specific type of exception here
            $order->delete();
            return redirect()->route('payment.failure')->with('error', 'Payment failed: ' . $e->getError()->message);
        } catch (\Exception $e) {
            // Other exceptions, such as network errors or Stripe API errors, will be caught here
            // You can log the error and inform the user about the failure
            $order->delete();
            return redirect()->route('payment.failure')->with('error', 'Payment failed: ' . $e->getMessage());
        }

         $carts = Cart::content();
         
         foreach ($carts as $cart) {
            Order::insert([
                'payment_id' => $order_id,
                'user_id' => Auth::user()->id,
                'course_id' => $cart->id,
                'instructor_id' => $cart->options['instructor'],
                'course_title' => $cart->name,
                'price' => $cart->price,
                'created_at' => Carbon::now(), 
            ]);
         }// end foreach 

         if (Session::has('coupon')) {
            Session::forget('coupon');
         }

         Cart::destroy();

         
         $data = [
              'invoice_no' => $order->invoice_no,
              'amount' => $order->total_amount,
              'name' => $order->name,
              'email' => $order->email,
         ];

         Mail::to($request->email)->send(new Orderconfirm($data));
         

         $notification = array(
            'message' => 'Stripe Payment Submit Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('index')->with($notification); 

    }

    public function InsCouponApply(Request $request){
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first(); 

        if ($coupon) {
            if ($coupon->course_id == $request->course_id && $coupon->instructor_id == $request->instructor_id) {

                Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                    'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
                ]);

                return response()->json(array(
                    'validity' => true,
                    'success' => 'Coupon Applied Successfully'
                )); 

            } else {
                return response()->json(['error' => 'Coupon Criteria Not Met for this course and instructor']);
            }
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function MarkAsRead(Request $request, $notificationId){

        $user = Auth::user();
        $notification = $user->notifications()->where('id',$notificationId)->first();

        if ($notification) {
            $notification->markAsRead();

        }
        return response()->json(['count' => $user->unreadNotifications()->count()]);

    }
    
}
