@extends('admin.admin_dashboard')
@section('admin')

@php

$id = Auth::user()->id;
$instructorId = App\Models\User::find($id);
$profileData = App\Models\User::find($id);
$status = $instructorId->status;
$totalNumberCourse = App\Models\Course::where('instructor_id', $instructorId->id )->count();
$totalNumberOrder = App\Models\Order::where('instructor_id', $instructorId->id)->count();
$totalNumberQuestion = App\Models\Question::where('instructor_id', $instructorId->id)->where('parent_id', null)->count();
$totalNumberReview = App\Models\Review::where('instructor_id', $instructorId->id)->where('status','1' )->count();

@endphp

<div class="page-content" style="min-width: 20rem;">
	<div class="card radius-10 border-start border-0 border-4 border-info">
		<div class="card-body d-flex flex-wrap align-items-center justify-content-between">
			<div class="media media-card align-items-center">
				<div class="media-img media--img media-img-md rounded-full">              
					<img style="max-height:6.25rem;" class="rounded-full" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/instructor_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Student thumbnail image">
				</div>
				<div class="media-body">
					<h2 class="section__title fs-30">Welcome, {{$profileData->name}}</h2>
			</div><!-- end media-body -->
		</div><!-- end media -->
	
		</div>
	</div>

		<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
						
			@if (Auth::user()->can('category.all')) 
			<div class="col">
				<div class="card radius-10 border-start border-0 border-4 border-info">
				   <a href="{{route('all.category')}}" class="btn btn-transparent">
					   <div class="card-body">
						   <div class="row align-items-center ">
							   <div class="col-4">
								<div class="row justify-content-center">
									   <!-- Icon -->
									   <div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
									   <i class="bx bx bx-category fs-1"></i>
								   </div>
								</div>
							   </div>
							   <div class="col-8 text-dark fs-6 fw-bold ">
								   <!-- Text -->
								   <div class="row justify-content-start">
								   Category
								   </div>
							   </div>
						   </div>
					   </div>
				   </a>
				</div>
			</div>
		   @endif

			@if (Auth::user()->can('instructor.status')) 
			<div class="col">
				<div class="card radius-10 border-start border-0 border-4 border-info">
				   <a href="{{route('show.all.instructor')}}" class="btn btn-transparent">
					   <div class="card-body">
						   <div class="row align-items-center ">
							   <div class="col-4">
								<div class="row justify-content-center">
									   <!-- Icon -->
									   <div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
									   <i class="bx bx-user fs-1"></i>
								   </div>
								</div>
							   </div>
							   <div class="col-8 text-dark fs-6 fw-bold ">
								   <!-- Text -->
								   <div class="row justify-content-start">
								   Instructor Status
								   </div>
							   </div>
						   </div>
					   </div>
				   </a>
				</div>
			</div>
		   @endif

		   @if (Auth::user()->can('blog.all')) 
		   <div class="col">
			   <div class="card radius-10 border-start border-0 border-4 border-info">
				  <a href="{{route('blog.post')}}" class="btn btn-transparent">
					  <div class="card-body">
						  <div class="row align-items-center ">
							  <div class="col-4">
							   <div class="row justify-content-center">
									  <!-- Icon -->
									  <div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
									  <i class="bx bx-book-open fs-1"></i>
								  </div>
							   </div>
							  </div>
							  <div class="col-8 text-dark fs-6 fw-bold ">
								  <!-- Text -->
								  <div class="row justify-content-start">
								  Blog
								  </div>
							  </div>
						  </div>
					  </div>
				  </a>
			   </div>
		   </div>
		  @endif

		  @if (Auth::user()->can('setting.all')) 
		  <div class="col">
			  <div class="card radius-10 border-start border-0 border-4 border-info">
				 <a href="{{route('site.setting')}}" class="btn btn-transparent">
					 <div class="card-body">
						 <div class="row align-items-center ">
							 <div class="col-4">
							  <div class="row justify-content-center">
									 <!-- Icon -->
									 <div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
									 <i class="bx bx-cog fs-1"></i>
								 </div>
							  </div>
							 </div>
							 <div class="col-8 text-dark fs-6 fw-bold ">
								 <!-- Text -->
								 <div class="row justify-content-start">
								 Site Setting
								 </div>
							 </div>
						 </div>
					 </div>
				 </a>
			  </div>
		  </div>
		 @endif

		 @if (Auth::user()->can('course.all')) 
		 <div class="col">
			 <div class="card radius-10 border-start border-0 border-4 border-info">
				<a href="{{route('admin.all.course')}}" class="btn btn-transparent">
					<div class="card-body">
						<div class="row align-items-center ">
							<div class="col-4">
							 <div class="row justify-content-center">
									<!-- Icon -->
									<div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
									<i class="bx bx-book fs-1"></i>
								</div>
							 </div>
							</div>
							<div class="col-8 text-dark fs-6 fw-bold ">
								<!-- Text -->
								<div class="row justify-content-start">
								Course
								</div>
							</div>
						</div>
					</div>
				</a>
			 </div>
		 </div>
		@endif

		@if (Auth::user()->can('coupon.all')) 
		<div class="col">
			<div class="card radius-10 border-start border-0 border-4 border-info">
			   <a href="{{route('admin.all.coupon')}}" class="btn btn-transparent">
				   <div class="card-body">
					   <div class="row align-items-center ">
						   <div class="col-4">
							<div class="row justify-content-center">
								   <!-- Icon -->
								   <div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
								   <i class="bx bx-gift fs-1"></i>
							   </div>
							</div>
						   </div>
						   <div class="col-8 text-dark fs-6 fw-bold ">
							   <!-- Text -->
							   <div class="row justify-content-start">
							   Coupon
							   </div>
						   </div>
					   </div>
				   </div>
			   </a>
			</div>
		</div>
	   @endif

	   @if (Auth::user()->can('order.all')) 
	   <div class="col">
		   <div class="card radius-10 border-start border-0 border-4 border-info">
			  <a href="{{route('admin.pending.order')}}" class="btn btn-transparent">
				  <div class="card-body">
					  <div class="row align-items-center ">
						  <div class="col-4">
						   <div class="row justify-content-center">
								  <!-- Icon -->
								  <div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
								  <i class="bx bx-receipt fs-1"></i>
							  </div>
						   </div>
						  </div>
						  <div class="col-8 text-dark fs-6 fw-bold ">
							  <!-- Text -->
							  <div class="row justify-content-start">
							  Order
							  </div>
						  </div>
					  </div>
				  </div>
			  </a>
		   </div>
	   </div>
	  @endif

	  @if (Auth::user()->can('review.all')) 
	  <div class="col">
		  <div class="card radius-10 border-start border-0 border-4 border-info">
			 <a href="{{route('admin.pending.review')}}" class="btn btn-transparent">
				 <div class="card-body">
					 <div class="row align-items-center ">
						 <div class="col-4">
						  <div class="row justify-content-center">
								 <!-- Icon -->
								 <div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
								 <i class="bx bx-star fs-1"></i>
							 </div>
						  </div>
						 </div>
						 <div class="col-8 text-dark fs-6 fw-bold ">
							 <!-- Text -->
							 <div class="row justify-content-start">
							 Review
							 </div>
						 </div>
					 </div>
				 </div>
			 </a>
		  </div>
	  </div>
	 @endif

	 @if (Auth::user()->can('report.all')) 
	 <div class="col">
		 <div class="card radius-10 border-start border-0 border-4 border-info">
			<a href="{{route('report.view')}}" class="btn btn-transparent">
				<div class="card-body">
					<div class="row align-items-center ">
						<div class="col-4">
						 <div class="row justify-content-center">
								<!-- Icon -->
								<div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
								<i class="bx bx-book-content fs-1"></i>
							</div>
						 </div>
						</div>
						<div class="col-8 text-dark fs-6 fw-bold ">
							<!-- Text -->
							<div class="row justify-content-start">
							Report
							</div>
						</div>
					</div>
				</div>
			</a>
		 </div>
	 </div>
	@endif

	@if (Auth::user()->can('user.status')) 
	<div class="col">
		<div class="card radius-10 border-start border-0 border-4 border-info">
		   <a href="{{route('all.user')}}" class="btn btn-transparent">
			   <div class="card-body">
				   <div class="row align-items-center ">
					   <div class="col-4">
						<div class="row justify-content-center">
							   <!-- Icon -->
							   <div class="widgets-icons-2 rounded-circle bg-primary text-white me-3 p-0">
							   <i class="bx bx-group fs-1"></i>
						   </div>
						</div>
					   </div>
					   <div class="col-8 text-dark fs-6 fw-bold ">
						   <!-- Text -->
						   <div class="row justify-content-start">
						   User Status
						   </div>
					   </div>
				   </div>
			   </div>
		   </a>
		</div>
	</div>
   @endif

   @if (Auth::user()->can('role.permission.all')) 
   <div class="col">
	   <div class="card radius-10 border-start border-0 border-4 border-info">
		  <a href="{{route('all.roles.permission')}}" class="btn btn-transparent">
			  <div class="card-body">
				  <div class="row align-items-center ">
					  <div class="col-4">
					   <div class="row justify-content-center">
							  <!-- Icon -->
							  <div class="widgets-icons-2 rounded-circle text-white me-3 p-0" style="background-color: var(--bs-indigo); ">
							  <i class="bx bx-sitemap fs-1"></i>
						  </div>
					   </div>
					  </div>
					  <div class="col-8 text-dark fs-6 fw-bold ">
						  <!-- Text -->
						  <div class="row justify-content-start">
						  Role & Permission
						  </div>
					  </div>
				  </div>
			  </div>
		  </a>
	   </div>
   </div>
  @endif

  @if (Auth::user()->can('role.permission.all')) 
  <div class="col">
	  <div class="card radius-10 border-start border-0 border-4 border-info">
		 <a href="{{route('all.admin')}}" class="btn btn-transparent">
			 <div class="card-body">
				 <div class="row align-items-center ">
					 <div class="col-4">
					  <div class="row justify-content-center">
							 <!-- Icon -->
							 <div class="widgets-icons-2 rounded-circle text-white me-3 p-0" style="background-color: var(--bs-indigo);">
							 <i class="bx bx-user-check fs-1"></i>
						 </div>
					  </div>
					 </div>
					 <div class="col-8 text-dark fs-6 fw-bold ">
						 <!-- Text -->
						 <div class="row justify-content-start">
						 Admin Management
						 </div>
					 </div>
				 </div>
			 </div>
		 </a>
	  </div>
  </div>
 @endif

 
 <div class="col">
	 <div class="card radius-10 border-start border-0 border-4 border-info">
		<a href="{{route('admin.profile')}}" class="btn btn-transparent">
			<div class="card-body">
				<div class="row align-items-center ">
					<div class="col-4">
					 <div class="row justify-content-center">
							<!-- Icon -->
							<div class="widgets-icons-2 rounded-circle text-white me-3 p-0" style="background-color: var(--bs-pink);">
							<i class="bx bx-user-circle fs-1"></i>
						</div>
					 </div>
					</div>
					<div class="col-8 text-dark fs-6 fw-bold ">
						<!-- Text -->
						<div class="row justify-content-start">
						Profile
						</div>
					</div>
				</div>
			</div>
		</a>
	 </div>
 </div>

 <div class="col">
	<div class="card radius-10 border-start border-0 border-4 border-info">
	   <a href="{{route('admin.change.password')}}" class="btn btn-transparent">
		   <div class="card-body">
			   <div class="row align-items-center ">
				   <div class="col-4">
					<div class="row justify-content-center">
						   <!-- Icon -->
						   <div class="widgets-icons-2 rounded-circle text-white me-3 p-0" style="background-color: var(--bs-pink);">
						   <i class="bx bx-lock fs-1"></i>
					   </div>
					</div>
				   </div>
				   <div class="col-8 text-dark fs-6 fw-bold ">
					   <!-- Text -->
					   <div class="row justify-content-start">
					   Change Password
					   </div>
				   </div>
			   </div>
		   </div>
	   </a>
	</div>
</div>

<div class="col">
	<div class="card radius-10 border-start border-0 border-4 border-info">
	   <a href="{{route('admin.logout')}}" class="btn btn-transparent">
		   <div class="card-body">
			   <div class="row align-items-center ">
				   <div class="col-4">
					<div class="row justify-content-center">
						   <!-- Icon -->
						   <div class="widgets-icons-2 rounded-circle text-white me-3 p-0" style="background-color: var(--bs-danger);">
						   <i class="bx bx-power-off fs-1"></i>
					   </div>
					</div>
				   </div>
				   <div class="col-8 text-dark fs-6 fw-bold ">
					   <!-- Text -->
					   <div class="row justify-content-start">
					   Log Out
					   </div>
				   </div>
			   </div>
		   </div>
	   </a>
	</div>
</div>


		 


			
	
					 
					
			
				
		</div>
</div>
@endsection