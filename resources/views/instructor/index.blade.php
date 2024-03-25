@extends('instructor.instructor_dashboard')
@section('instructor')

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

<div class="page-content">
 
	@if($status === '1')
	<h4>This Instructor Account is <span class="text-success">Active</span></h4>

<div class="card radius-10 border-start border-0 border-4 border-info">
	<div class="card-body d-flex flex-wrap align-items-center justify-content-between">

	<div class="media media-card align-items-center">
		<div class="media-img media--img media-img-md rounded-full">              
			<img class="rounded-full" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/instructor_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Student thumbnail image">
		</div>
		<div class="media-body">
			<h2 class="section__title fs-30">Welcome, {{$profileData->name}}</h2>
{{--                         <div class="rating-wrap d-flex align-items-center pt-2">
				<div class="review-stars">
					<span class="rating-number">4.4</span>
					<span class="la la-star"></span>
					<span class="la la-star"></span>
					<span class="la la-star"></span>
					<span class="la la-star"></span>
					<span class="la la-star-o"></span>
				</div>
				<span class="rating-total pl-1">(20,230)</span>
			</div><!-- end rating-wrap --> --}}
		</div><!-- end media-body -->
	</div><!-- end media -->

	</div>
</div>

				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                   <div class="col">
					 <div class="card radius-10 border-start border-0 border-4 border-info">
						<a href="{{route('show.instructor.course')}}" class="btn btn-transparent">
						<div class="card-body">
							
							<div class="row align-items-center">
								
								<div class="col-3 me-3 p-0">
									<!-- Icon -->
									<div class="widgets-icons-2 rounded-circle bg-primary text-white ms-auto">
									<i class="la la-book fs-1"></i>
									</div>
								</div>
								<div class="col-auto">
									<!-- Text -->
									<div class="text-dark fs-6 fw-bold">Course:</div>
									<div class="fs-5">{{$totalNumberCourse}}</div>
								</div>
							</div>
							
	{{-- 						<div class="d-flex align-items-center">
								<div>
									<p class="mb-0 text-secondary">Total Orders</p>
									<h4 class="my-1 text-info">4805</h4>
									<p class="mb-0 font-13">+2.5% from last week</p>
								</div>
								<div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
								</div>
							</div> --}}
						</div>
					</a>
					 </div>
				   </div>

				   <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-info">
					   <a href="{{route('instructor.all.order')}}" class="btn btn-transparent">
					   <div class="card-body">
						   
						   <div class="row align-items-center">
							   
							<div class="col-3 me-3 p-0">
								   <!-- Icon -->
								   <div class="widgets-icons-2 rounded-circle text-white ms-auto" style="background-color: var(--bs-indigo);">
								   <i class="la la-receipt fs-1"></i>
								   </div>
							   </div>
							   <div class="col-auto">
								   <!-- Text -->
								   <div class="text-dark fs-6 fw-bold">Order:</div>
								   <div class="fs-5">{{$totalNumberOrder}}</div>
							   </div>
						   </div>
						   
   {{-- 						<div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Orders</p>
								   <h4 class="my-1 text-info">4805</h4>
								   <p class="mb-0 font-13">+2.5% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
							   </div>
						   </div> --}}
					   </div>
				   </a>
					</div>
				  </div>


{{-- 				  <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-info">
					   <a href="{{route('instructor.all.question')}}" class="btn btn-transparent">
					   <div class="card-body">
						   
						   <div class="row align-items-center">
							   
							<div class="col-3 me-3 p-0">
								   <!-- Icon -->
								   <div class="widgets-icons-2 rounded-circle bg-secondary text-white ms-auto">
								   <i class="la la-question fs-1"></i>
								   </div>
							   </div>
							   <div class="col-auto">
								   <!-- Text -->
								   <div class="text-dark fs-6 fw-bold">Question:</div>
								   <div class="fs-5">{{$totalNumberQuestion}}</div>
							   </div>
						   </div>
						   
  						<div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Orders</p>
								   <h4 class="my-1 text-info">4805</h4>
								   <p class="mb-0 font-13">+2.5% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
							   </div>
						   </div> 
					   </div>
				   </a>
					</div>
				  </div> --}}


				  <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-info">
					   <a href="{{route('instructor.all.review')}}" class="btn btn-transparent">
					   <div class="card-body">
						   
						   <div class="row align-items-center">
							   
							<div class="col-3 me-3 p-0">
								   <!-- Icon -->
								   <div class="widgets-icons-2 rounded-circle text-white ms-auto" style="background-color: var(--bs-teal);">
								   <i class="la la-star-o fs-1"></i>
								   </div>
							   </div>
							   <div class="col-auto">
								   <!-- Text -->
								   <div class="text-dark fs-6 fw-bold">Review:</div>
								   <div class="fs-5">{{$totalNumberReview}}</div>
							   </div>
						   </div>
						   
   {{-- 						<div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Orders</p>
								   <h4 class="my-1 text-info">4805</h4>
								   <p class="mb-0 font-13">+2.5% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
							   </div>
						   </div> --}}
					   </div>
				   </a>
					</div>
				  </div>


				  <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-info">
					   <a href="{{route('instructor.node.chat')}}" class="btn btn-transparent">
					   <div class="card-body">
						   
						   <div class="row align-items-center">
							   
							<div class="col-3 me-3 p-0">
								   <!-- Icon -->
								   <div class="widgets-icons-2 rounded-circle bg-warning text-white ms-auto">
								   <i class="la la-comment fs-1"></i>
								   </div>
							   </div>
							   <div class="col-auto">
								   <!-- Text -->
								   <div class="text-dark fs-6 fw-bold">Chat:</div>
								   <div class="fs-5" id="indexMessQty">0</div>
							   </div>
						   </div>
						   
   {{-- 						<div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Orders</p>
								   <h4 class="my-1 text-info">4805</h4>
								   <p class="mb-0 font-13">+2.5% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
							   </div>
						   </div> --}}
					   </div>
				   </a>
					</div>
				  </div>

				  <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-info">
					   <a href="{{route('instructor.profile')}}" class="btn btn-transparent">
					   <div class="card-body">
						   
						   <div class="row align-items-center">
							   
							<div class="col-3 me-3 p-0">
								   <!-- Icon -->
								   <div class="widgets-icons-2 rounded-circle bg-info text-white ms-auto">
								   <i class="la la-user fs-1"></i>
								   </div>
							   </div>
							   <div class="col-auto">
								   <!-- Text -->
								   <div class="text-dark fs-6 fw-bold">Profile</div>
							   </div>
						   </div>
						   
   {{-- 						<div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Orders</p>
								   <h4 class="my-1 text-info">4805</h4>
								   <p class="mb-0 font-13">+2.5% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
							   </div>
						   </div> --}}
					   </div>
				   </a>
					</div>
				  </div>

				  <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-info">
					   <a href="{{route('instructor.change.password')}}" class="btn btn-transparent" style="min-width: 290px;">
					   <div class="card-body">
						   
						   <div class="row align-items-center">
							   
							<div class="col-3 me-0 p-0">
								   <!-- Icon -->
								   <div class="widgets-icons-2 rounded-circle bg-dark text-white ms-auto ">
								   <i class="la la-lock fs-1 p-0 m-0"></i>
								   </div>
							   </div>
							   <div class="col-auto text-dark fw-bold" style="font-size: clamp(0.5rem, 5vw, 0.9rem);">
								   <!-- Text -->
								  Change Password
							   </div>
						   </div>
						   
   {{-- 						<div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Orders</p>
								   <h4 class="my-1 text-info">4805</h4>
								   <p class="mb-0 font-13">+2.5% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
							   </div>
						   </div> --}}
					   </div>
				   </a>
					</div>
				  </div>

				  <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-info">
					   <a href="{{route('instructor.logout')}}" class="btn btn-transparent">
					   <div class="card-body">
						   
						   <div class="row align-items-center">
							   
							<div class="col-3 me-3 p-0">
								   <!-- Icon -->
								   <div class="widgets-icons-2 rounded-circle bg-danger text-white ms-auto">
								   <i class="la la-power-off fs-1"></i>
								   </div>
							   </div>
							   <div class="col-auto">
								   <!-- Text -->
								   <div class="text-dark fs-6 fw-bold">Log Out</div>
							   </div>
						   </div>
						   
   {{-- 						<div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Orders</p>
								   <h4 class="my-1 text-info">4805</h4>
								   <p class="mb-0 font-13">+2.5% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
							   </div>
						   </div> --}}
					   </div>
				   </a>
					</div>
				  </div>
				   

			

				</div><!--end row-->
				@else
				<h4>This Instructor Account is <span class="text-danger">Inactive</span></h4>
				<p class="text-danger"><b>Please contact administrator of this website to active your account</b></p>
				
			@endif
			</div>
@endsection