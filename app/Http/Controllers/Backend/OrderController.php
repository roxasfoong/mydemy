<?php

namespace App\Http\Controllers\Backend;

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
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Question;

class OrderController extends Controller
{
    public function AdminPendingOrder(){
        $payment = Payment::where('status','pending')->orderBy('id','DESC')->get();
        return view('admin.backend.orders.pending_orders',compact('payment'));
    }  

    public function AdminOrderDetails($payment_id){
        $payment = Payment::where('id',$payment_id)->first();
        $orderItem = Order::where('payment_id',$payment_id)->orderBy('id','DESC')->get();
        return view('admin.backend.orders.admin_order_details',compact('payment','orderItem'));
    }

    public function PendingToConfirm($payment_id){
        Payment::find($payment_id)->update(['status' => 'confirm']);
        $notification = array(
            'message' => 'Order Confrim Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.confirm.order')->with($notification);  
    }

    public function AdminConfirmOrder(){
        $payment = Payment::where('status','confirm')->orderBy('id','DESC')->get();
        return view('admin.backend.orders.confirm_orders',compact('payment'));
    }

/**
 * Retrieve all orders associated with the authenticated instructor user.
 * Orders are grouped by payment ID and only the latest order for each payment is retrieved.
 * 
 * @return \Illuminate\View\View
 */
public function InstructorAllOrder(){
    // Retrieve the ID of the authenticated user
    $id = Auth::user()->id;
    
    // Select the payment ID and the maximum order ID for each payment
    $latestOrderItem = Order::where('instructor_id', $id)
                            ->select('payment_id', \DB::raw('MAX(id) as max_id'))
                            ->groupBy('payment_id');
    
    // Join the main Order table with the subquery containing the latest order IDs
    // Orders are joined based on the maximum order ID per payment
    // Results are ordered by the maximum order ID in descending order
    $orderItem = Order::joinSub($latestOrderItem, 'latest_order', function($join) {
                        $join->on('orders.id', '=', 'latest_order.max_id');
                    })->orderBy('latest_order.max_id', 'DESC')
                    ->get(); 

    // Pass the retrieved order items to the view for display
    return view('instructor.orders.all_orders', compact('orderItem'));
}





    public function InstructorOrderDetails($payment_id){

        $payment = Payment::where('id',$payment_id)->first();
        $orderItem = Order::where('payment_id',$payment_id)->orderBy('id','DESC')->get();

        return view('instructor.orders.instructor_order_details',compact('payment','orderItem'));

    }

    public function InstructorOrderInvoice($payment_id){
        $payment = Payment::where('id',$payment_id)->first();
        $orderItem = Order::where('payment_id',$payment_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('instructor.orders.order_pdf',compact('payment','orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    /* ------------User Display Order Function------------- */

    public function MyCourse(){
        $id = Auth::user()->id;
        $latestOrders = Order::where('user_id',$id)->select('course_id', \DB::raw('MAX(id) as max_id'))->groupBy('course_id');
        $mycourse = Order::joinSub($latestOrders, 'latest_order', function($join) {
            $join->on('orders.id', '=', 'latest_order.max_id');
        })->orderBy('latest_order.max_id','DESC')->get();
        return view('frontend.mycourse.my_all_course',compact('mycourse'));
    }
 
    public function CourseView($course_id){
        $id = Auth::user()->id;
        $course = Order::where('course_id',$course_id)->where('user_id',$id)->first();
        $section = CourseSection::where('course_id',$course_id)->orderBy('id','asc')->get();
        $allquestion = Question::latest()->get();

        return view('frontend.mycourse.course_view',compact('course','section','allquestion'));

    }

    /* ------------User Order Function------------- */

} 
