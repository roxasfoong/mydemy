@extends('frontend.master')
@section('home')
@section('title')
@php
if (!$category) {
    abort(404); // Redirect to 404 page
}
@endphp
{{ $category->category_name }} | Ez Buy & Learn Online Course
@endsection

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">Catgory : {{$category->category_name}}</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><b>{{$category->category_name}}</b></li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE AREA
======================================-->
<section class="course-area section--padding">
    <div class="container">
        <div class="filter-bar mb-4">
            <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                <p class="fs-14">Found <span class="text-black">{{count($courses)}}</span> courses available.</p>
             {{--    
                <div class="d-flex flex-wrap align-items-center">
                    <ul class="filter-nav mr-3">
                        <li><a href="course-grid.html" data-toggle="tooltip" data-placement="top" title="Grid View" class="active"><span class="la la-th-large"></span></a></li>
                        <li><a href="course-list.html" data-toggle="tooltip" data-placement="top" title="List View"><span class="la la-list"></span></a></li>
                    </ul>
                    <div class="select-container select--container">
                        <select class="select-container-select">
                            <option value="all-category">All Category</option>
                            <option value="newest">Newest courses</option>
                            <option value="oldest">Oldest courses</option>
                            <option value="high-rated">Highest rated</option>
                            <option value="popular-courses">Popular courses</option>
                            <option value="high-to-low">Price: high to low</option>
                            <option value="low-to-high">Price: low to high</option>
                        </select>
                    </div>
                </div> --}}

            </div><!-- end filter-bar-inner -->
        </div><!-- end filter-bar -->
        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar mb-5">

                  {{--   <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Search Field</h3>
                            <div class="divider"><span></span></div>
                            <form method="post">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="text" name="search" placeholder="Search courses">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card --> 

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Ratings</h3>
                            <div class="divider"><span></span></div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="fiveStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="fiveStarRating">
                                   <span class="rating-wrap d-flex align-items-center">
                                         <span class="review-stars">
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                         </span>
                                       <span class="rating-total pl-1"><span class="mr-1 text-black">5.0</span>(20,230)</span>
                                   </span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="fourStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="fourStarRating">
                                   <span class="rating-wrap d-flex align-items-center">
                                         <span class="review-stars">
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                         </span>
                                       <span class="rating-total pl-1"><span class="mr-1 text-black">4.5 & up</span>(10,230)</span>
                                   </span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="threeStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="threeStarRating">
                                    <span class="rating-wrap d-flex align-items-center">
                                        <span class="review-stars">
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                        </span>
                                        <span class="rating-total pl-1"><span class="mr-1 text-black">3.0 & up</span>(7,230)</span>
                                    </span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="twoStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="twoStarRating">
                                   <span class="rating-wrap d-flex align-items-center">
                                       <span class="review-stars">
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                       </span>
                                       <span class="rating-total pl-1"><span class="mr-1 text-black">2.0 & up</span>(5,230)</span>
                                   </span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="oneStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="oneStarRating">
                                    <span class="rating-wrap d-flex align-items-center">
                                        <span class="review-stars">
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                        </span>
                                        <span class="rating-total pl-1"><span class="mr-1 text-black">1.0 & up</span>(3,230)</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div><!-- end card -->--}}
                    
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Course Categories</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                                @foreach ($categories as $cat)
                                 <li><a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}">{{ $cat->category_name }}</a></li> 
                                @endforeach 
 
                             </ul>
                        </div>
                    </div><!-- end card -->

                    @foreach($categories as $findCategory)
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">{{$findCategory->category_name}}</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                    @foreach($allCourses as $findCourse)
                                @if($findCourse->main_category_id == $findCategory->id)
                                <li><a href="{{ url('/course/details/' .$findCourse->id .'/'. $findCourse->course_name_slug) }}">{{ $findCourse->course_name }}</a></li> 
                                @endif
                    @endforeach
                </ul>
            </div>
        </div><!-- end card -->
                    @endforeach

                    {{-- <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Level</h3>
                            <div class="divider"><span></span></div>
                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                <input type="checkbox" class="custom-control-input" id="levelCheckbox" required>
                                <label class="custom-control-label custom--control-label text-black" for="levelCheckbox">
                                    All Levels<span class="ml-1 text-gray">(20,300)</span>
                                </label>
                            </div><!-- end custom-control -->
                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                <input type="checkbox" class="custom-control-input" id="levelCheckbox2" required>
                                <label class="custom-control-label custom--control-label text-black" for="levelCheckbox2">
                                    Beginner<span class="ml-1 text-gray">(5,300)</span>
                                </label>
                            </div><!-- end custom-control -->
                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                <input type="checkbox" class="custom-control-input" id="levelCheckbox3" required>
                                <label class="custom-control-label custom--control-label text-black" for="levelCheckbox3">
                                    Intermediate<span class="ml-1 text-gray">(3,300)</span>
                                </label>
                            </div><!-- end custom-control -->
                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                <input type="checkbox" class="custom-control-input" id="levelCheckbox4" required>
                                <label class="custom-control-label custom--control-label text-black" for="levelCheckbox4">
                                    Expert<span class="ml-1 text-gray">(1,300)</span>
                                </label>
                            </div><!-- end custom-control -->
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">By Cost</h3>
                            <div class="divider"><span></span></div>
                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                <input type="checkbox" class="custom-control-input" id="priceCheckbox" required>
                                <label class="custom-control-label custom--control-label text-black" for="priceCheckbox">
                                    Paid<span class="ml-1 text-gray">(19,300)</span>
                                </label>
                            </div><!-- end custom-control -->
                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                <input type="checkbox" class="custom-control-input" id="priceCheckbox2" required>
                                <label class="custom-control-label custom--control-label text-black" for="priceCheckbox2">
                                    Free<span class="ml-1 text-gray">(1,300)</span>
                                </label>
                            </div><!-- end custom-control -->
                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                <input type="checkbox" class="custom-control-input" id="priceCheckbox3" required>
                                <label class="custom-control-label custom--control-label text-black" for="priceCheckbox3">
                                    All<span class="ml-1 text-gray">(20,300)</span>
                                </label>
                            </div><!-- end custom-control -->
                        </div>
                    </div><!-- end card --> --}}


                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-8">
                <div class="row">
                    @foreach ($courses as $course)
                    <div class="col-lg-6 responsive-column-half">
                        <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                            <div class="card-image">
                                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                                    <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="images/img8.jpg" alt="Card image cap">
                                </a>
                
                                @php
                                $amount = $course->selling_price - $course->discount_price;
                                $discount = ($amount/$course->selling_price) * 100;
                            @endphp
                
                
                                <div class="course-badge-labels">
                                    @if ($course->bestseller == 1)
                                    <div class="course-badge">Bestseller</div>
                                    @else
                                    @endif
                
                                    @if ($course->discount_price == NULL)
                                    <div class="course-badge blue">New</div>
                                    @else
                                    <div class="course-badge blue">{{ round($discount) }}%</div>
                                    @endif
                                </div>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
                                <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                              {{--   <p class="card-text"><a href=" ">{{ $course['user']['name'] }}</a></p>
                                <div class="rating-wrap d-flex align-items-center py-2">
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
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($course->discount_price == NULL)
                                    <p class="card-price text-black font-weight-bold">${{ $course->selling_price }}  </p>
                                    @else
                                    <p class="card-price text-black font-weight-bold">${{ $course->discount_price }} <span class="before-price font-weight-medium">${{ $course->selling_price }}</span></p> 
                                    @endif 
                
                                    {{-- <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist"><i class="la la-heart-o"></i></div> --}}
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col-lg-6 --> 
                      @endforeach
                </div><!-- end row -->
                <div class="text-center pt-3">
                    <div class="text-center pt-3">
                        <nav aria-label="Page navigation example" class="pagination-box">
                                {{ $courses->links('vendor.pagination.custom') }}
                        </nav>

                        <p class="fs-14 pt-2">Total Number of Posts : {{count($courses)}}</p>
                    </div>
                    
                </div>
            </div><!-- end col-lg-8 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->


@endsection