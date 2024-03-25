@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')

<div class="container-fluid">

    <div class="section-block mb-5"></div>
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">My Courses</h3>
    </div>
    <div class="dashboard-cards mb-5">

       @foreach ($mycourse as $item)
        <div class="card card-item card-item-list-layout">
            <div class="card-image">
                <a href="{{ route('course.view',$item->course_id) }}" class="d-block">
                    <img class="card-img-top" src="{{ asset($item->course->course_image) }}" alt="Card image cap">
                </a>

            </div><!-- end card-image -->
            <div class="card-body">
                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $item->course->label }}</h6>
                <h5 class="card-title"><a href="course-details.html">{{ $item->course->course_name }}</a></h5>
                <p class="card-text"><a href="teacher-detail.html">{{ $item->course->user->name }}</a></p>

                @php
                $reviewcount = App\Models\Review::where('course_id',$item->id)->where('status',1)->latest()->get();
                $avarage = App\Models\Review::where('course_id',$item->id)->where('status',1)->avg('rating');
                @endphp

                <div class="rating-wrap d-flex flex-wrap align-items-center">
                    <div class="review-stars">
                        <span class="rating-number">{{ round($avarage,1) }}</span>

                        @if ($avarage == 0)
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        @elseif ($avarage == 1 || $avarage < 2)
                        <span class="la la-star"></span>
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        @elseif ($avarage == 2 || $avarage < 3)
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        @elseif ($avarage == 3 || $avarage < 4)
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star-o"></span>
                        <span class="la la-star-o"></span>
                        @elseif ($avarage == 4 || $avarage < 5)
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star-o"></span>
                        @elseif ($avarage == 5 || $avarage < 5)
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        @endif 
                    </div>
                    <span class="rating-total pl-1">({{ count($reviewcount) }} ratings)</span>
                </div>
                <ul class="card-duration d-flex align-items-center fs-15 pb-2">
    
                    @php
                    $enrollmentCount = App\Models\Order::where('course_id',$item->id)->count();
                    $totalHours = '';
    
                    if($item->course->duration % 60 > 0){
                        $totalHours = intval($item->course->duration/60);
                    }
                    else{
                        $totalHours = $item->course->duration / 60;
                    }
                @endphp

                    <li class="mr-2">
                        <span class="text-black">Duration:</span>
                        <span>{{ $totalHours }} hours </span>
                    </li>

                   
                    <li class="mr-2">
                        <span class="text-black">Students:</span>
                        <span>{{ number_format($enrollmentCount) }}</span>
                    </li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="card-price text-black font-weight-bold">${{ $item->course->selling_price }}</p>

                </div>
            </div><!-- end card-body -->
        </div><!-- end card --> 
        @endforeach

    </div><!-- end col-lg-12 -->
</div><!-- end container-fluid -->

@endsection