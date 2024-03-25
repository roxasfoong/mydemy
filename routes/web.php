<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GDCheckController;

use App\Http\Controllers\frontend\WishListController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ChatController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [UserController::class, 'Index'])->name('index');
Route::get('/socket.io', [ChatController::class, 'ChatTest'])->name('chat.test');
Route::get('/get-user-message-count',[ChatController::class,'GetUserMessageCount']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth','roles:user', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
 
    // Chat Post Request Route
    Route::post('/send-message', [ChatController::class, 'SendMessage']);
    Route::post('/send-message-to-instructor', [ChatController::class, 'SendMessageToInstructor'])->name('send.message.to.instructor');
    Route::get('/user-all', [ChatController::class, 'GetAllUsers']);
    Route::get('/user-message/{id}', [ChatController::class, 'UserMsgById']);
    Route::get('/delete-message-count/{id}', [ChatController::class, 'DelSenderMessage']);

    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/update/profile', [UserController::class, 'UserUpdateProfile'])->name('user.update.profile');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');

    //Livechat Route
    Route::get('/live/chat', [UserController::class, 'LiveChat'])->name('live.chat');
    Route::get('/live/node/chat', [UserController::class, 'LiveNodeChat'])->name('live.Node.chat');

    Route::controller(WishListController::class)->group(function(){
        Route::get('/user/wishlist','AllWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-course/','GetWishlistCourse');
        Route::get('/wishlist-remove/{id}','RemoveWishlist');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/my/course','MyCourse')->name('my.course'); 
        Route::get('/course/view/{course_id}','CourseView')->name('course.view');
    });

         // User Question All Route 
/*          Route::controller(QuestionController::class)->group(function(){
            Route::post('/user/question','UserQuestion')->name('user.question');  
    
        }); */

    });

/*     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); */

require __DIR__.'/auth.php';

//Admin Group Middleware
Route::middleware(['auth','roles:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    
    // Permission All Route 
    Route::controller(RoleController::class)->group(function(){

    Route::group(['middleware' => ['permission:role.permission.all']], function () {
    Route::get('/all/permission','AllPermission')->name('all.permission'); 
    Route::get('/add/permission','AddPermission')->name('add.permission');
    Route::post('/store/permission','StorePermission')->name('store.permission'); 
    Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');
    Route::post('/update/permission','UpdatePermission')->name('update.permission');
    Route::get('/delete/permission/{id}','DeletePermission')->name('delete.permission');
    Route::get('/import/permission','ImportPermission')->name('import.permission');
    Route::get('/export','Export')->name('export');
    Route::post('/import','Import')->name('import');
    }); 
}); 

    //Roles All Route
    Route::controller(RoleController::class)->group(function(){

        Route::group(['middleware' => ['permission:role.permission.all']], function () {
        Route::get('/all/roles','AllRoles')->name('all.roles');
        Route::get('/add/roles','AddRoles')->name('add.roles'); 
        Route::post('/store/roles','StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}','EditRoles')->name('edit.roles');
        Route::post('/update/roles','UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}','DeleteRoles')->name('delete.roles');  
        Route::get('/add/roles/permission','AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store','RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission','AllRolesPermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}','AdminEditRoles')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}','AdminUpdateRoles')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}','AdminDeleteRoles')->name('admin.delete.roles');
    }); 
}); 

    // Manage Admin User Route 
    Route::controller(AdminController::class)->group(function(){

    Route::group(['middleware' => ['permission:role.permission.all']], function () {
        Route::get('/all/admin','AllAdmin')->name('all.admin'); 
        Route::get('/add/admin','AddAdmin')->name('add.admin');
        Route::post('/store/admin','StoreAdmin')->name('store.admin'); 
        Route::get('/edit/admin/{id}','EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}','UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}','DeleteAdmin')->name('delete.admin'); 
    });

    });

    // Admin Report All Route 
    Route::controller(ReportController::class)->group(function(){

        Route::group(['middleware' => ['permission:report.all']], function () {
            Route::get('/report/view','ReportView')->name('report.view');
            Route::post('/search/by/date','SearchByDate')->name('search.by.date'); 
            Route::post('/search/by/month','SearchByMonth')->name('search.by.month');
            Route::post('/search/by/year','SearchByYear')->name('search.by.year');
        });
    });

    //Category Routes
    Route::controller(CategoryController::class)->group(function(){

        Route::group(['middleware' => ['permission:category.all']], function () {
            Route::get('/all/category','AllCategory')->name('all.category');
            
        /*  Route::get('/all/category','AllCategory')->name('all.category')->middleware('permission:category.all'); */
            Route::get('/add/category','AddCategory')->name('add.category');
            Route::post('/store/category','StoreCategory')->name('store.category');
            Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
            Route::post('/update/category','UpdateCategory')->name('update.category');
            Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
        });

    });

    //SubCategory Routes
    Route::controller(CategoryController::class)->group(function(){

        Route::group(['middleware' => ['permission:category.all']], function () {
        //Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory')->middleware('permission:subcategory.all');
        Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
    });
});


        //Manages Intructor Routes
        Route::controller(AdminController::class)->group(function(){

            Route::group(['middleware' => ['permission:instructor.status']], function () {
            Route::get('/show/all/instructor','AllInstructor')->name('show.all.instructor');
            Route::post('/update/user/status','UpdateUserStatus')->name('update.user.status');
           
        });
    });
        // Admin Coruses All Route 
    Route::controller(AdminController::class)->group(function(){

        Route::group(['middleware' => ['permission:course.all']], function () {
    Route::get('/admin/all/course','AdminAllCourse')->name('admin.all.course');
    Route::post('/update/course/stauts','UpdateCourseStatus')->name('update.course.stauts');
    Route::get('/admin/course/details/{id}','AdminCourseDetails')->name('admin.course.details');
    });
});

    // Admin Coupon All Route 
    Route::controller(CouponController::class)->group(function(){

        Route::group(['middleware' => ['permission:coupon.all']], function () {
    Route::get('/admin/all/coupon','AdminAllCoupon')->name('admin.all.coupon');
    Route::get('/admin/add/coupon','AdminAddCoupon')->name('admin.add.coupon');
    Route::post('/admin/store/coupon','AdminStoreCoupon')->name('admin.store.coupon');
    Route::get('/admin/edit/coupon/{id}','AdminEditCoupon')->name('admin.edit.coupon');
    Route::post('/admin/update/coupon','AdminUpdateCoupon')->name('admin.update.coupon');
    Route::get('/admin/delete/coupon/{id}','AdminDeleteCoupon')->name('admin.delete.coupon'); 
    });
});


    // Site Setting All Route 
    Route::controller(SettingController::class)->group(function(){

        Route::group(['middleware' => ['permission:setting.all']], function () {
    Route::get('/site/setting','SiteSetting')->name('site.setting'); 
    Route::post('/update/site','UpdateSite')->name('update.site'); 
    });
});

    // Admin Smtp Setting Configuration
    Route::controller(SettingController::class)->group(function(){

        Route::group(['middleware' => ['permission:setting.all']], function () {
        Route::get('/smtp/setting','SmtpSetting')->name('smtp.setting');
        Route::post('/update/smtp','SmtpUpdate')->name('update.smtp');
    });
});

    // Admin Order Management
    Route::controller(OrderController::class)->group(function(){

        Route::group(['middleware' => ['permission:order.all']], function () {
        Route::get('/admin/pending/order','AdminPendingOrder')->name('admin.pending.order'); 
        Route::get('/admin/order/details/{id}','AdminOrderDetails')->name('admin.order.details'); 
        Route::get('/pending-confrim/{id}','PendingToConfirm')->name('pending-confrim');
        Route::get('/admin/confirm/order','AdminConfirmOrder')->name('admin.confirm.order');  
    });
});

    // Admin Review All Route 
    Route::controller(ReviewController::class)->group(function(){

        Route::group(['middleware' => ['permission:review.all']], function () {
        Route::get('/admin/pending/review','AdminPendingReview')->name('admin.pending.review'); 
        Route::post('/update/review/stauts','UpdateReviewStatus')->name('update.review.stauts'); 
        Route::get('/admin/active/review','AdminActiveReview')->name('admin.active.review');
    });
});

    // Admin All user and Instructor All Route 
    Route::controller(ActiveUserController::class)->group(function(){

        Route::group(['middleware' => ['permission:user.status']], function () {
        Route::get('/all/user','AllUser')->name('all.user'); 
        Route::get('/all/instructor','AllInstructor')->name('all.instructor'); 
    });
});
    // Blog Category All Route 
    Route::controller(BlogController::class)->group(function(){

        Route::group(['middleware' => ['permission:blog.all']], function () {
    Route::get('/blog/category','AllBlogCategory')->name('blog.category');   
    Route::post('/blog/category/store','StoreBlogCategory')->name('blog.category.store');   
    Route::get('/edit/blog/category/{id}','EditBlogCategory');  
    Route::post('/blog/category/update','UpdateBlogCategory')->name('blog.category.update'); 
    Route::get('/delete/blog/category/{id}','DeleteBlogCategory')->name('delete.blog.category'); 
    });
    });

    // Blog Post All Route 
    Route::controller(BlogController::class)->group(function(){

        Route::group(['middleware' => ['permission:blog.all']], function () {
    Route::get('/blog/post','BlogPost')->name('blog.post'); 
    Route::get('/add/blog/post','AddBlogPost')->name('add.blog.post'); 
    Route::post('/store/blog/post','StoreBlogPost')->name('store.blog.post');
    Route::get('/edit/post/{id}','EditBlogPost')->name('edit.post');  
    Route::post('/update/blog/post','UpdateBlogPost')->name('update.blog.post');
    Route::get('/delete/post/{id}','DeleteBlogPost')->name('delete.post');  
    });
    });
    
});

Route::middleware(['auth','roles:instructor'])->group(function(){
    
    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');
    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor/update/password', [InstructorController::class, 'InstructorUpdatePassword'])->name('instructor.update.password');


    // Instructor Coupon All Route 
    Route::controller(CouponController::class)->group(function(){
    Route::get('/instructor/all/coupon','InstructorAllCoupon')->name('instructor.all.coupon');
    Route::get('/instructor/add/coupon','InstructorAddCoupon')->name('instructor.add.coupon');
    Route::post('/instructor/store/coupon','InstructorStoreCoupon')->name('instructor.store.coupon');
    Route::get('/instructor/edit/coupon/{id}','InstructorEditCoupon')->name('instructor.edit.coupon');
    Route::post('/instructor/update/coupon','InstructorUpdateCoupon')->name('instructor.update.coupon');
    Route::get('/instructor/delete/coupon/{id}','InstructorDeleteCoupon')->name('instructor.delete.coupon');
    });

    /* Course Management Route By Instructor */
        Route::controller(CourseController::class)->group(function(){
        Route::get('/show/instructor/course','ShowInstructorCourse')->name('show.instructor.course');
        Route::get('/add/course','AddCourse')->name('add.course');
        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
        Route::post('/store/course','StoreCourse')->name('store.course');
        Route::get('/edit/course/{id}','EditCourse')->name('edit.course');
        Route::post('/update/course','UpdateCourse')->name('update.course');
        Route::get('/delete/course/{id}','DeleteCourse')->name('delete.course');
      });

      /* Course Section & Lecture Management Route By Instructor */
      Route::controller(CourseController::class)->group(function(){
        Route::get('/add/course/lecture/{id}','AddCourseLecture')->name('add.course.lecture');
        Route::post('/store/course/section','StoreCourseSection')->name('store.course.section');
        Route::post('/save-lecture/','SaveLecture')->name('save-lecture');
        Route::get('/edit/lecture/{id}','EditLecture')->name('edit.lecture');
        Route::post('/update/course/lecture','UpdateCourseLecture')->name('update.course.lecture');
        Route::get('/delete/lecture/{id}','DeleteLecture')->name('delete.lecture');
        Route::post('/delete/section/{id}','DeleteSection')->name('delete.section');
      });
 
      // Instructor All Order Route 
    Route::controller(OrderController::class)->group(function(){
    Route::get('/instructor/all/order','InstructorAllOrder')->name('instructor.all.order'); 
    Route::get('/instructor/order/details/{payment_id}','InstructorOrderDetails')->name('instructor.order.details'); 
    Route::get('/instructor/order/invoice/{payment_id}','InstructorOrderInvoice')->name('instructor.order.invoice');
    });
    
    // Question Route 
/*     Route::controller(QuestionController::class)->group(function(){
    Route::get('/instructor/all/question','InstructorAllQuestion')->name('instructor.all.question'); 
    Route::get('/question/details/{id}','QuestionDetails')->name('question.details'); 
    Route::post('/instructor/replay','InstructorReplay')->name('instructor.replay'); 
    }); */

    // Instructor Review All Route 
    Route::controller(ReviewController::class)->group(function(){
    Route::get('/instructor/all/review','InstructorAllReview')->name('instructor.all.review');  
    });

    // Instructor Chat
    //Route::get('/instructor/live/chat', [ChatController::class, 'LiveChat'])->name('instructor.live.chat');
    Route::get('/chat/node', [ChatController::class, 'ChatNode'])->name('instructor.node.chat');
    
});

/* Able to Access by All User Role */

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login')->middleware(RedirectIfAuthenticated::class);

//Display a correct course detail with id/slug
Route::get('/course/details/{id}/{slug}', [IndexController::class, 'CourseDetails']);

//WishList
Route::post('/add-to-wishlist/{course_id}', [WishListController::class, 'AddToWishList']);

//Blog Post
Route::get('/blog/details/{slug}', [BlogController::class, 'BlogDetails']);
Route::get('/blog/cat/list/{id}', [BlogController::class, 'BlogCatList']);
Route::get('/blog/post/tag/{tag}', [BlogController::class, 'BlogTagList']);
Route::get('/blog', [BlogController::class, 'BlogList'])->name('blog');

//Notification
Route::post('/mark-notification-as-read/{notification}', [CartController::class, 'MarkAsRead']);

// Chat Post Request Route
Route::post('/send-message', [ChatController::class, 'SendMessage'])->name('send.message.to.instructor');
Route::get('/user-all', [ChatController::class, 'GetAllUsers']);
Route::get('/user-message/{id}', [ChatController::class, 'UserMsgById']);
Route::get('/delete-message-count/{id}', [ChatController::class, 'DelSenderMessage']);


//Review Route
Route::post('/store/review', [ReviewController::class, 'StoreReview'])->name('store.review');

//Cart & Coupon Route Management
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::post('/inscoupon-apply', [CartController::class, 'InsCouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::post('/buy/data/store/{id}', [CartController::class, 'BuyToCart']);
Route::get('/cart/data/', [CartController::class, 'CartData']);
Route::get('/course/mini/cart/', [CartController::class, 'AddMiniCart']);
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::post('/payment', [CartController::class, 'Payment'])->name('payment');
Route::post('/stripe_order', [CartController::class, 'StripeOrder'])->name('stripe_order');
Route::controller(CartController::class)->group(function(){
    Route::get('/mycart','MyCart')->name('mycart');
    Route::get('/get-cart-course','GetCartCourse');
    Route::get('/cart-remove/{rowId}','CartRemove');
});

//Instructor Related Pages
Route::get('/instructor/details/{id}', [IndexController::class, 'InstructorDetails'])->name('instructor.details');
Route::get('/category/{id}/{slug}', [IndexController::class, 'CategoryCourse']);
Route::get('/category/all', [IndexController::class, 'CategoryAll'])->name('show.all.category');
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'SubCategoryCourse']);


//To show reigster as instructor page
Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');
Route::post('/instructor/register', [AdminController::class, 'InstructorRegister'])->name('instructor.register');

//Extra
Route::get('/check-gd', [GDCheckController::class, 'checkGDExtension']);
Route::get('/minicart/course/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

/* Able to Access by All User Role */
