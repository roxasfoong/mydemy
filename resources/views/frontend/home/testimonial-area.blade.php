@php
       $reviews = App\Models\Review::where('status',1)->limit(6)->latest()->get();
       $totalReviews = App\Models\Review::count();
@endphp

<section class="testimonial-area section-padding">


    <div class="course-wrapper">
        <div class="container">
            <div class="section-heading text-center">
                <h5 class="ribbon ribbon-lg mb-2">Course Review</h5>
                <h2 class="section__title">Student's Feedback</h2>
                <span class="section-divider"></span>
            </div><!-- end section-heading -->
            <div class="row mt-30px">

                @foreach  ($reviews as $item)
                <div class="col-lg-4 responsive-column-half">
                <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_3">
                    <div class="card-image">
                       <a href="{{ url('course/details/' . $item['course']['id'] .'/'. $item['course']['course_name_slug']) }}" class="d-block mb-3">
                            <img class="card-img-top" src="{{ asset($item['course']['course_image']) }}" alt="Card image cap">
                            <h5>{{$item['course']['course_name']}}</h5>
                        </a>
                        <div class="media media-card align-items-center pb-3">
                            <div class="media-img avatar-md">
                                @if($item->user->role == 'user')
                                <img class="rounded-full lazy" src="{{ (!empty($item->user->photo)) && $item->user->photo != 'photo' ? url('upload/user_images/'.$item->user->photo) : url('upload/no_image.jpg')}}" data-src="images/small-avatar-1.jpg" alt="User image">
                                @elseif($item->user->role == 'instructor')
                                <img class="rounded-full lazy" src="{{ (!empty($item->user->photo)) && $item->user->photo != 'photo' ? url('upload/instructor_images/'.$item->user->photo) : url('upload/no_image.jpg')}}" data-src="images/small-avatar-1.jpg" alt="User image">
                                @elseif($item->user->role == 'admin')
                                <img class="rounded-full lazy" src="{{ (!empty($item->user->photo)) && $item->user->photo != 'photo' ? url('upload/admin_images/'.$item->user->photo) : url('upload/no_image.jpg')}}" data-src="images/small-avatar-1.jpg" alt="User image">
                                @endif
                            </div>
                            <div class="media-body">
                                <h5>{{ $item->user->name }}</h5>
                                <div class="d-flex align-items-center pt-1">
    
                                    <div class="review-stars">
                                        @if($item->rating == NULL)
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 1)
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 2)
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 3)
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 4)
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 5)
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><!-- end media -->
                        <p class="card-text">
                            {{ $item->comment }}
                        </p>
     
                </div><!-- end card -->
            </div><!-- end tab-content -->
                </div>
            @endforeach
        </div><!-- end container -->
    </div><!-- end course-wrapper -->
</section><!-- end testimonial-area -->