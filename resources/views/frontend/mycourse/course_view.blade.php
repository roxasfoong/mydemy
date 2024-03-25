@extends('frontend.master2')
@section('home')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> 

@php
    $setting = App\Models\SiteSetting::find(1);
    $categories = App\Models\Category::orderBy('category_name', 'asc')->take(6)->get();
    $courses = App\Models\Course::inRandomOrder()->orderBy('course_name', 'asc')->take(4)->get();
    @endphp
<!--======================================
        START HEADER AREA
    ======================================-->
    <section class="header-menu-area">
        <div class="header-menu-content bg-dark">
            <div class="container-fluid">
                <div class="main-menu-content d-flex align-items-center">
                    <div class="p-3" ><a href="{{route('index')}}"" class="text-primary"><i class="la la-home" style="font-size: 2rem;"></i></a></div>
                    <div>
                        <div class="theme-picker d-flex align-items-center">
                            <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                <svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>
                    </div><!-- end logo-box -->
                    <div class="course-dashboard-header-title pl-4">
                        <a href="{{url()->previous()}}" class="text-white fs-15">{{ $course->course->course_name }}</a>
                    </div><!-- end course-dashboard-header-title -->
                    <div>
                        <a href="{{route('dashboard')}}" class="btn btn-danger lh-26 m-3">Dashboard</a>
                    </div>
                 {{--    <div class="menu-wrapper ml-auto">
                        <div class="theme-picker d-flex align-items-center mr-3">
                            <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                <svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="nav-right-button d-flex align-items-center">
                            <a href="{{url('/course/details/' . $course->course->id . '/'. $course->course->course_name_slug)}}" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2"><i class="la la-star mr-1"></i> Rate This Course</a>
                            <a href="#" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2" data-toggle="modal" data-target="#shareModal"><i class="la la-share mr-1"></i> share</a>
                            <div class="generic-action-wrap generic--action-wrap">
                                <div class="dropdown">
                                    <a class="action-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Favorite this course</a>
                                        <a class="dropdown-item" href="#">Archive this course</a>
                                        <a class="dropdown-item" href="#">Gift this course</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end nav-right-button -->
                    </div><!-- end menu-wrapper --> --}}
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
    </section><!-- end header-menu-area -->
    <!--======================================
            END HEADER AREA
    ======================================-->

    <!--======================================
        START COURSE-DASHBOARD
======================================-->
<section class="course-dashboard">
    <div class="course-dashboard-wrap">
        <div class="course-dashboard-container d-flex">
            <div class="course-dashboard-column">
                <div class="lecture-viewer-container">
                    <div class="lecture-video-item">
                        <iframe width="100%" height="500" id="videoContainer" src="" 
                        title="The Best Way to Learn With Videos and Online Classes I Video Notebook" frameborder="0" 
                        allow="autoplay" 
                        allowfullscreen></iframe>
                        
            <div id="textLesson" class="fs-24 font-weight-semi-bold pb-2 text-center mt-4">
            <h3></h3>
            </div> 
            
                    </div> 
                </div><!-- end lecture-viewer-container -->
                <div class="lecture-video-detail">
                    <div class="lecture-tab-body bg-gray p-4">
                        <ul class="nav nav-tabs generic-tab" id="myTab" role="tablist">
                        {{--     <li class="nav-item">
                                <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="false">
                                    <i class="la la-search"></i>
                                </a>
                            </li> --}}
                            <li class="nav-item mobile-menu-nav-item">
                                <a class="nav-link" id="course-content-tab" data-toggle="tab" href="#course-content" role="tab" aria-controls="course-content" aria-selected="false">
                                    Course Content
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
                                    Overview
                                </a>
                            </li>
                           {{--  <li class="nav-item">
                                <a class="nav-link" id="question-and-ans-tab" data-toggle="tab" href="#question-and-ans" role="tab" aria-controls="question-and-ans" aria-selected="false">
                                    Question & Ans
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="announcements-tab" data-toggle="tab" href="#announcements" role="tab" aria-controls="announcements" aria-selected="false">
                                    Announcements
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="lecture-video-detail-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
                                <div class="search-course-wrap pt-40px">
                                    <form action="#" class="pb-5">
                                        <div class="input-group">
                                            <input class="form-control form--control form--control-gray pl-3" type="text" name="search" placeholder="Search course content">
                                            <div class="input-group-append">
                                                <button class="btn theme-btn"><span class="la la-search"></span></button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="search-results-message text-center">
                                        <h3 class="fs-24 font-weight-semi-bold pb-1">Start a new search</h3>
                                        <p>To find captions, lectures or resources</p>
                                    </div>
                                </div><!-- end search-course-wrap -->
                            </div><!-- end tab-pane -->
                            <div class="tab-pane fade" id="course-content" role="tabpanel" aria-labelledby="course-content-tab">


                                <div class="mobile-course-menu pt-4">
                                    <div class="accordion generic-accordion generic--accordion" id="mobileCourseAccordionCourseExample">

                                                @foreach ($section as $sec)

                                                @php
                                                    $lectures = App\Models\CourseLecture::where('section_id',$sec->id)->get();
                                                @endphp
                    
                            <div class="card">
                            <div class="card-header" id="mobileCourseHeadingOne{{ $sec->id }}">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#McollapseOne{{ $sec->id }}" aria-expanded="true" aria-controls="McollapseOne">
                    
                                                            <i class="la la-angle-down"></i>
                                                            <i class="la la-angle-up"></i>
                                                            <span class="fs-15"> {{ $sec->section_tittle }}</span>
                                                            <span class="course-duration"> 
                                                                <span>({{ count($lectures) }})</span>
                                                            </span>
                                                        </button>
                                                    </div><!-- end card-header -->
                                                    <div id="McollapseOne{{ $sec->id }}" class="collapse " aria-labelledby="mobileCourseHeadingOne{{ $sec->id }}" data-parent="#mobileCourseAccordionCourseExample">
                                                        <div class="card-body p-0">
                                                            <ul class="curriculum-sidebar-list">
                                                                @foreach ($lectures as $lect)
                                                                <li class="course-item-link active">
                                                                    <div class="course-item-content-wrap">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="courseCheckbox" required>
                                                                            <label class="custom-control-label custom--control-label" for="courseCheckbox"></label>
                                                                        </div><!-- end custom-control -->
                                                                        <div class="course-item-content">
                                                                            <h4 class="fs-15 lecture-title" data-video-url="{{ $lect->url }}" data-content="{{$lect->content }}">{{ $lect->lecture_tittle }}</h4>
                                                                        </div><!-- end course-item-content -->
                                                                    </div><!-- end course-item-content-wrap -->
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div><!-- end card-body -->
                                                    </div><!-- end collapse -->
                                                </div><!-- end card --> 
                                                @endforeach
                                    </div><!-- end accordion-->
                                </div><!-- end mobile-course-menu -->


                            </div><!-- end tab-pane -->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                <div class="lecture-overview-wrap">
                                    <div class="lecture-overview-item">
                                        <h3 class="fs-24 font-weight-semi-bold pb-2">About this course</h3>
                                        <p>{{ $course->course->course_tittle }}</p>
                                    </div><!-- end lecture-overview-item -->
                                    <div class="section-block"></div>
                                    <div class="lecture-overview-item">
                                        <div class="row">

                                            <div class="col">
                                                <ul class="generic-list-item">
                                                    @php

                                                    $level = '';
                                                    switch($course->course->level){
                                                    case 1:
                                                    $level =  "Beginner";
                                                        break;
                                                    case 2:
                                                    $level = "Intermediate";
                                                        break;
                                                    case 3:
                                                    $level = "Advanced";
                                                        break;
                                                    case 4:
                                                    $level = "All Levels";
                                                        break;
                                                    default:
                                                    $level = "Unknown Level";
                                                    }
                
                                                    @endphp
                                                    <li><span>Category</span>{{ $course->course['category']['category_name'] }}</li>
                                                    <li><span>Subcategory</span>{{ $course->course['Subcategory']['subcategory_name'] }}</li>
                                                    <li><span>Skill level:</span>{{ $level }}</li>
                                                    @php
                                                    $enrollmentCount = App\Models\Order::where('course_id',$course->course->id)->count();
                                                    @endphp
                                                    <li><span>Students:</span>{{number_format($enrollmentCount)}}</li>
                                                    <li><span>Resourse:</span>{{ $course->course->resources }}</li>
                                    @php

                                    $totalHours = '';
                
                                    if($course->course->duration % 60 > 0){
                                        $totalHours = intval($course->course->duration/60);
                                    }
                                    else{
                                        $totalHours = $course->course->duration / 60;
                                    }
                
                                    @endphp
                                    <li><span>Video length:</span>Around {{ $totalHours }} hours</li>
                                   
                                                </ul>
                                            </div><!-- end lecture-overview-stats-item -->
                                            <div class="lecture-overview-stats-item">
                                                <ul class="generic-list-item">
                                    
                                                </ul>
                                            </div><!-- end lecture-overview-stats-item -->
                                        </div><!-- end lecture-overview-stats-wrap -->
                                    </div><!-- end lecture-overview-item -->
                                    <div class="section-block"></div>
       
                                    <div class="section-block"></div>
                                   
                                    <div class="section-block"></div>
                                    <div class="lecture-overview-item">
                                        <div class="lecture-overview-stats-wrap d-flex">
                                            <div class="lecture-overview-stats-item">
                                                <h3 class="fs-16 font-weight-semi-bold pb-2">Description</h3>
                                            </div><!-- end lecture-overview-stats-item -->
                                            <div class="lecture-overview-stats-item lecture-overview-stats-wide-item lecture-description">
                                                
                                                <p> {!! $course->course->description !!} </p>
                            
                            
                            
                            
                                            </div><!-- end lecture-overview-stats-item -->
                                        </div><!-- end lecture-overview-stats-wrap -->
                                    </div><!-- end lecture-overview-item -->
                                    <div class="section-block"></div>
                            
                                </div><!-- end lecture-overview-wrap -->
                            </div><!-- end tab-pane -->

                            <div class="tab-pane fade" id="question-and-ans" role="tabpanel" aria-labelledby="question-and-ans-tab">
                                <div class="lecture-overview-wrap lecture-quest-wrap">
                                    <div class="new-question-wrap">
                                        <button class="btn theme-btn theme-btn-transparent back-to-question-btn"><i class="la la-reply mr-1"></i>Back to all questions</button>
                                        <div class="new-question-body pt-40px">
                                            <h3 class="fs-20 font-weight-semi-bold">My question relates to</h3>
                                            <form method="post" action="{{ route('index') }}" class="pt-4">
                                                @csrf
                                        
                                                <input type="hidden" name="course_id" value="{{ $course->course_id }}">
                                                <input type="hidden" name="instructor_id" value="{{ $course->instructor_id }}">
                                        
                                                <div class="custom-control-wrap">
                                                    <div class="custom-control custom-radio mb-3 pl-0">
                                                        <input type="text" name="subject" class="form-control form--control pl-3" >
                                        
                                                    </div>
                                        
                                                    <div class="custom-control custom-radio mb-3 pl-0">
                                                        <textarea class="form-control form--control pl-3" name="question" rows="4" placeholder="Write your response..."></textarea>
                                        
                                                    </div>
                                        
                                                </div>
                                                <div class="btn-box text-center">
                                                    <button type="submit" class="btn theme-btn w-100">Submit Question <i class="la la-arrow-right icon ml-1"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- end new-question-wrap -->

                                    <div class="question-overview-result-wrap">

                                        <div class="lecture-overview-item">
                                            <div class="question-overview-result-header d-flex align-items-center justify-content-between">
                                                <h3 class="fs-17 font-weight-semi-bold">{{ count($allquestion) }} questions in this course</h3>
                                                <button class="btn theme-btn theme-btn-sm theme-btn-transparent ask-new-question-btn">Ask a new question</button>
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item mt-0">
                                            <div class="question-list-item">
                                                
                                                @php
                                                $id = Auth::user()->id;
                                                $question = App\Models\Question::where('user_id',$id)->where('course_id',$course->course->id)->where('parent_id',null)->orderBy('id','asc')->get();
                                                @endphp     

                                                @foreach ($question as $que)
                                                <div class="media media-card border-bottom border-bottom-gray py-4 px-3">
                                                    <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                                                        <img class="rounded-full" src="{{ (!empty($que->user->photo)) && $que->user->photo != 'photo' ? url('upload/user_images/'.$que->user->photo) : url('upload/no_image.jpg')}}" alt="User image">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="question-meta-content">
                                                                <div class="d-block">
                                                                    <h5 class="fs-16 pb-1">{{ $que->subject }} </h5>
                                                                    <p class="text-truncate fs-15 text-primary">
                                                                                        {{ $que->question }}
                                                                    </div>
                                                            </div><!-- end question-meta-content -->

                                                        </div>
                                                        <p class="meta-tags pt-1 fs-13"> 
                                                            <span>{{ Carbon\Carbon::parse($que->created_at)->diffForHumans() }}</span>
                                                        </p>
                                                    </div><!-- end media-body -->
                                                </div><!-- end media -->

                                                @php
                                                $replay = App\Models\Question::where('parent_id',$que->id)->get();
                                                @endphp      

                    @foreach ($replay as $rep)
                    <div class="media media-card border-bottom border-bottom-gray py-4 px-3" style="background: #e6e6e6">
                        <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                            <img class="rounded-full" src="{{ (!empty($rep->instructor->photo)) ? url('upload/instructor_images/'.$rep->instructor->photo) : url('upload/no_image.jpg')}}" alt="User image">
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="question-meta-content">
                                    <a href="javascript:void(0)" class="d-block">
                       <h5 class="fs-16 pb-1">{{ $rep->instructor->name }} </h5>
                      <p class="text-truncate fs-15 text-body">
                                          {{ $rep->question }}
                                        </p>
                                    </a>
                                </div><!-- end question-meta-content -->

                            </div>
                            <p class="meta-tags pt-1 fs-13"> 
                                <span>{{ Carbon\Carbon::parse($rep->created_at)->diffForHumans() }}</span>
                            </p>
                        </div><!-- end media-body -->
                    </div><!-- end media --> 

                    @endforeach
                                                @endforeach

                                            </div>
                                            <div class="question-btn-box pt-35px text-center">
                                                <button class="btn theme-btn theme-btn-transparent w-100" type="button">See More</button>
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                    </div>
                                </div>
                            </div><!-- end tab-pane -->

                            <div class="tab-pane fade" id="announcements" role="tabpanel" aria-labelledby="announcements-tab">
                                <div class="lecture-overview-wrap lecture-announcement-wrap">
                                    <div class="lecture-overview-item">
                                        <div class="media media-card align-items-center">
                                            <a href="teacher-detail.html" class="media-img d-block rounded-full avatar-md">
                                                <img src="images/small-avatar-1.jpg" alt="Instructor avatar" class="rounded-full">
                                            </a>
                                            <div class="media-body">
                                                <h5 class="pb-1"><a href="teacher-detail.html">Alex Smith</a></h5>
                                                <div class="announcement-meta fs-15">
                                                    <span>Posted an announcement</span>
                                                    <span> · 3 years ago ·</span>
                                                    <a href="#" class="btn-text" data-toggle="modal" data-target="#reportModal" title="Report abuse"><i class="la la-flag"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lecture-owner-decription pt-4">
                                            <h3 class="fs-19 font-weight-semi-bold pb-3">Important Q&A support</h3>
                                            <p>Happy 2019 to everyone, thank you for being a student and all of your support.</p>
                                            <p><strong>Great job on enrolling and your current course progress.  I encourage you keep in pursuit of your dreams :)</strong></p>
                                            <p>The whole lot. In my course After Effects Complete Course packed with all Techniques and Methods (No Tricks and gimmicks).</p>
                                            <p class="font-italic"><strong>Unfortunately this will result in delayed responses by me in the Q&A section and to direct messages.  This is only for the next week  and once back I will be back to 100% .</strong></p>
                                            <p>I will continue to do my best to respond to as many questions as possible but only one person, regularly I spend 4-5 hours daily on this and with over 440000 students as you can image that its a lot of work.</p>
                                            <p class="font-italic">Thank you once again for your understanding and for all of the wonderful students who I have had an opportunity to communicate with regularly and all of your encouragement.</p>
                                            <p>Have an awesome day</p>
                                            <p>Alex</p>
                                        </div>
                                        <div class="lecture-announcement-comment-wrap pt-4">
                                            <div class="media media-card align-items-center">
                                                <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                                    <img src="images/small-avatar-1.jpg" alt="Instructor avatar" class="rounded-full">
                                                </div><!-- end media-img -->
                                                <div class="media-body">
                                                    <form action="#">
                                                        <div class="input-group">
                                                            <input class="form-control form--control form--control-gray pl-3" type="text" name="search" placeholder="Enter your comment">
                                                            <div class="input-group-append">
                                                                <button class="btn theme-btn" type="button"><i class="la la-arrow-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- end media-body -->
                                            </div><!-- end media -->
                                            <div class="comments pt-40px">
                                                <div class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                                                    <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                                        <img src="images/small-avatar-2.jpg" alt="Instructor avatar" class="rounded-full">
                                                    </div><!-- end media-img -->
                                                    <div class="media-body">
                                                        <div class="announcement-meta fs-15 lh-20">
                                                            <a href="#" class="text-color">Tony Olsson</a>
                                                            <span> · 3 years ago ·</span>
                                                            <a href="#" class="btn-text" data-toggle="modal" data-target="#reportModal" title="Report abuse"><i class="la la-flag"></i></a>
                                                        </div>
                                                        <p class="pt-1">Occaecati cupiditate non provident, similique sunt in culpa fuga.</p>
                                                    </div><!-- end media-body -->
                                                </div><!-- end media -->
                                                <div class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                                                    <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                                        <img src="images/small-avatar-3.jpg" alt="Instructor avatar" class="rounded-full">
                                                    </div><!-- end media-img -->
                                                    <div class="media-body">
                                                        <div class="announcement-meta fs-15 lh-20">
                                                            <a href="#" class="text-color">Eduard-Dan</a>
                                                            <span> · 2 years ago ·</span>
                                                            <a href="#" class="btn-text" data-toggle="modal" data-target="#reportModal" title="Report abuse"><i class="la la-flag"></i></a>
                                                        </div>
                                                        <p class="pt-1">Occaecati cupiditate non provident, similique sunt in culpa fuga.</p>
                                                    </div><!-- end media-body -->
                                                </div><!-- end media -->
                                            </div><!-- end comments -->
                                        </div><!-- end lecture-announcement-comment-wrap -->
                                    </div><!-- end lecture-overview-item -->
                                </div>
                            </div><!-- end tab-pane -->
                        </div><!-- end tab-content -->
                    </div><!-- end lecture-video-detail-body -->
                </div><!-- end lecture-video-detail -->
              
                <section class="footer-area pt-100px">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 responsive-column-half">
                                <div class="footer-item">
                                    <a href="{{route('index')}}">
                                        <img src="{{ asset($setting->logo) }}" alt="footer logo" class="footer__logo">
                                    </a>
                                    <ul class="generic-list-item pt-4">
                                        <li><a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a></li>
                                        <li><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></li>
                                        <li>{{ $setting->address }}</li>
                                    </ul>
                                    <h3 class="fs-20 font-weight-semi-bold pt-4 pb-2">We are on</h3>
                                    <ul class="social-icons social-icons-styled">
                                        <li class="mr-1"><a href="{{ $setting->facebook }}" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                        {{--<li class="mr-1"><a href="{{ $setting->twitter }}" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                         <li class="mr-1"><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                                        <li class="mr-1"><a href="#" class="linkedin-bg"><i class="la la-linkedin"></i></a></li> --}}
                                    </ul>
                                </div><!-- end footer-item -->
                            </div><!-- end col-lg-3 -->
                            <div class="col-lg-3 responsive-column-half">
                                <div class="footer-item">
                                    <h3 class="fs-20 font-weight-semi-bold">Mydemy</h3>
                                    <span class="section-divider section--divider"></span>
                                    <ul class="generic-list-item">
                                        <li><a href="{{route('index')}}">Home</a></li>
                                        <li><a href="{{route('blog')}}">Blog</a></li>
                                        <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                                        <li><a href="{{route('my.course')}}">My Course</a></li>
                                        @auth
                                        <li><a href="{{route('user.logout')}}">Log out</a></li>
                                        @else
                                        <li><a href="{{route('login')}}">Log in</a></li>
                                        @endauth
                 
                                        <li><a href="{{route('become.instructor')}}">Become a Teacher</a></li>
                                    </ul>
                                </div><!-- end footer-item -->
                            </div><!-- end col-lg-3 --> 
                            <div class="col-lg-3 responsive-column-half">
                                <div class="footer-item">
                                    <h3 class="fs-20 font-weight-semi-bold">Random Courses</h3>
                                    <span class="section-divider section--divider"></span>
                                    <ul class="generic-list-item">
                                        @foreach($courses as $course)
                                        <li><a href="{{ url('/course/details/' . $course->id . '/' . $course->course_name_slug) }}">{{ $course->course_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- end footer-item -->
                            </div><!-- end col-lg-3 -->
                            <div class="col-lg-3 responsive-column-half">
                                <div class="footer-item">
                                    <h3 class="fs-20 font-weight-semi-bold">Courses Category</h3>
                                    <span class="section-divider section--divider"></span>
                                    <ul class="generic-list-item">
                                        @foreach($categories as $category)
                                        <li><a href="{{ url('/category/' . $category->id . '/' . $category->category_slug) }}">{{ $category->category_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- end footer-item -->
                            </div><!-- end col-lg-3 -->
                        </div><!-- end row -->
                    </div><!-- end container -->
                    <div class="section-block"></div>
                    <div class="copyright-content py-4">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <p class="copy-desc">  {{ $setting->copyright }}</p>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                {{--                     <div class="d-flex flex-wrap align-items-center justify-content-end">
                                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                                            <li class="mr-3"><a href="terms-and-conditions.html">Terms & Conditions</a></li>
                                            <li class="mr-3"><a href="privacy-policy.html">Privacy Policy</a></li>
                                        </ul>
                                        <div class="select-container select-container-sm">
                                            <select class="select-container-select">
                                                <option value="1">English</option>
                                                <option value="2">Deutsch</option>
                                                <option value="3">Español</option>
                                                <option value="4">Français</option>
                                                <option value="5">Bahasa Indonesia</option>
                                                <option value="6">Bangla</option>
                                                <option value="7">日本語</option>
                                                <option value="8">한국어</option>
                                                <option value="9">Nederlands</option>
                                                <option value="10">Polski</option>
                                                <option value="11">Português</option>
                                                <option value="12">Română</option>
                                                <option value="13">Русский</option>
                                                <option value="14">ภาษาไทย</option>
                                                <option value="15">Türkçe</option>
                                                <option value="16">中文(简体)</option>
                                                <option value="17">中文(繁體)</option>
                                                <option value="17">Hindi</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                        </div><!-- end container -->
                    </div><!-- end copyright-content -->
                </section><!-- end footer-area -->
            </div><!-- end course-dashboard-column -->
            <div class="course-dashboard-sidebar-column">
                <button class="sidebar-open" type="button"><i class="la la-angle-left"></i> Course content</button>
                <div class="course-dashboard-sidebar-wrap custom-scrollbar-styled">
                    <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
                        <h3 class="fs-18 font-weight-semi-bold">Course content</h3>
                        <button class="sidebar-close" type="button"><i class="la la-times"></i></button>
                    </div><!-- end course-dashboard-side-heading -->
                    <div class="course-dashboard-side-content">
                        <div class="accordion generic-accordion generic--accordion" id="accordionCourseExample">

                           @foreach ($section as $sec)

                            @php
                                $lectures = App\Models\CourseLecture::where('section_id',$sec->id)->get();
                            @endphp

        <div class="card">
        <div class="card-header" id="headingOne{{ $sec->id }}">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{ $sec->id }}" aria-expanded="true" aria-controls="collapseOne">

                                        <i class="la la-angle-down"></i>
                                        <i class="la la-angle-up"></i>
                                        <span class="fs-15"> {{ $sec->section_tittle }}</span>
                                        <span class="course-duration"> 
                                            <span>({{ count($lectures) }})</span>
                                        </span>
                                    </button>
                                </div><!-- end card-header -->
                                <div id="collapseOne{{ $sec->id }}" class="collapse " aria-labelledby="headingOne{{ $sec->id }}" data-parent="#accordionCourseExample">
                                    <div class="card-body p-0">
                                        <ul class="curriculum-sidebar-list">
                                            @foreach ($lectures as $lect)
                                            <li class="course-item-link active">
                                                <div class="course-item-content-wrap">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="courseCheckbox" required>
                                                        <label class="custom-control-label custom--control-label" for="courseCheckbox"></label>
                                                    </div><!-- end custom-control -->
                                                    <div class="course-item-content">
                                                        <h4 class="fs-15 lecture-title" data-video-url="{{ $lect->url }}" data-content="{{$lect->content }}">{{ $lect->lecture_tittle }}</h4>
                                                    </div><!-- end course-item-content -->
                                                </div><!-- end course-item-content-wrap -->
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div><!-- end card-body -->
                                </div><!-- end collapse -->
                            </div><!-- end card --> 
                            @endforeach

                        </div><!-- end accordion-->


                    </div><!-- end course-dashboard-side-content -->
                </div><!-- end course-dashboard-sidebar-wrap -->
            </div><!-- end course-dashboard-sidebar-column -->
        </div><!-- end course-dashboard-container -->
    </div><!-- end course-dashboard-wrap -->
</section><!-- end course-dashboard -->
<!--======================================
        END COURSE-DASHBOARD
======================================-->

{{-- --------Modeal Section---------- --}}
<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<!-- Modal -->
<div class="modal fade modal-container" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="ratingModalTitle">
                        How would you rate this course?
                    </h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body text-center py-5">
                <div class="leave-rating mt-5">
                    <input type="radio" name='rate' id="star5"/>
                    <label for="star5" class="fs-45"></label>
                    <input type="radio" name='rate' id="star4"/>
                    <label for="star4" class="fs-45"></label>
                    <input type="radio" name='rate' id="star3"/>
                    <label for="star3" class="fs-45"></label>
                    <input type="radio" name='rate' id="star2"/>
                    <label for="star2" class="fs-45"></label>
                    <input type="radio" name='rate' id="star1"/>
                    <label for="star1" class="fs-45"></label>
                    <div class="rating-result-text fs-20 pb-4"></div>
                </div><!-- end leave-rating -->
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<!-- Modal -->
<div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">Share this course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <div class="copy-to-clipboard">
                    <span class="success-message">Copied!</span>
                    <div class="input-group">
                        <input type="text" class="form-control form--control copy-input pl-3" value="https://www.aduca.com/share/101WxMB0oac1hVQQ==/">
                        <div class="input-group-append">
                            <button class="btn theme-btn theme-btn-sm copy-btn shadow-none"><i class="la la-copy mr-1"></i> Copy</button>
                        </div>
                    </div>
                </div><!-- end copy-to-clipboard -->
            </div><!-- end modal-body -->
            <div class="modal-footer justify-content-center border-top-gray">
                <ul class="social-icons social-icons-styled">
                    <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                    <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                    <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                </ul>
            </div><!-- end modal-footer -->
        </div><!-- end modal-content-->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<!-- Modal -->
<div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">Report Abuse</h5>
                    <p class="pt-1 fs-14 lh-24">Flagged content is reviewed by Aduca staff to determine whether it violates Terms of Service or Community Guidelines. If you have a question or technical issue, please contact our
                        <a href="contact.html" class="text-color hover-underline">Support team here</a>.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form method="post">
                    <div class="input-box">
                        <label class="label-text">Select Report Type</label>
                        <div class="form-group">
                            <div class="select-container w-auto">
                                <select class="select-container-select">
                                    <option value>-- Select One --</option>
                                    <option value="1">Inappropriate Course Content</option>
                                    <option value="2">Inappropriate Behavior</option>
                                    <option value="3">Aduca Policy Violation</option>
                                    <option value="4">Spammy Content</option>
                                    <option value="5">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="label-text">Write Message</label>
                        <div class="form-group">
                            <textarea class="form-control form--control pl-3" name="message" placeholder="Provide additional details here..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="btn-box text-right pt-2">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Submit <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<!-- Modal -->
<div class="modal fade modal-container" id="insertLinkModal" tabindex="-1" role="dialog" aria-labelledby="insertLinkModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="insertLinkModalTitle">Insert Link</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form action="#">
                    <div class="input-box">
                        <label class="label-text">URL</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="text" placeholder="Url">
                            <i class="la la-link input-icon"></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="label-text">Text</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="text" placeholder="Text">
                            <i class="la la-pencil input-icon"></i>
                        </div>
                    </div>
                    <div class="btn-box text-right pt-2">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Insert <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<!-- Modal -->
<div class="modal fade modal-container" id="uploadPhotoModal" tabindex="-1" role="dialog" aria-labelledby="uploadPhotoModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="uploadPhotoModalTitle">Upload an Image</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <div class="file-upload-wrap">
                    <input type="file" name="files[]" class="multi file-upload-input" multiple>
                    <span class="file-upload-text"><i class="la la-upload mr-2"></i>Drop files here or click to upload</span>
                </div><!-- file-upload-wrap -->
                <div class="btn-box text-right pt-2">
                    <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Submit <i class="la la-arrow-right icon ml-1"></i></button>
                </div>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->
{{-- --------Modeal Section---------- --}}

<script type="text/javascript">
    // Function to open the first lecture when the page loads
    function openFirstLecture() {
        const firstLecture = document.querySelector('.lecture-title'); // Get the first lecture element
        if (firstLecture) {
            firstLecture.click(); // Trigger the click event on the first lecture
        }
    }
    // Function to handle lecture clicks and load content
    function viewLesson(videoUrl, vimeoUrl, textContent) {
        const video = document.getElementById("videoContainer");
        const text = document.getElementById("textLesson");
        const textContainer = document.createElement("div");
        if (videoUrl && videoUrl.trim() !== "") {
            video.classList.remove("d-none");
            text.classList.add("d-none");
            text.innerHTML = "";
            video.setAttribute("src", videoUrl);
        } else if (vimeoUrl && vimeoUrl.trim() !== "") {
            video.classList.remove("d-none");
            text.classList.add("d-none");
            text.innerHTML = "";
            video.setAttribute("src", vimeoUrl);
        } else if (textContent && textContent.trim() !== "") {
            video.classList.add("d-none");
            text.classList.remove("d-none");
            text.innerHTML = "";
            textContainer.innerHTML = textContent;
            textContainer.style.fontSize = "14px";
            textContainer.style.textAlign = "left";
            textContainer.style.paddingLeft = "40px";
            textContainer.style.paddingRight = "40px";
            text.appendChild(textContainer);
        }
    }
    // Add a click event listener to all lecture elements
    document.querySelectorAll('.lecture-title').forEach((lectureTitle) => {
        lectureTitle.addEventListener('click', () => {
            const videoUrl = lectureTitle.getAttribute('data-video-url');
            const vimeoUrl = lectureTitle.getAttribute('data-vimeo-url');
            const textContent = lectureTitle.getAttribute('data-content');
            viewLesson(videoUrl, vimeoUrl, textContent);
        });
    });
    // Open the first lecture when the page loads
    window.addEventListener('load', () => {
        openFirstLecture();
    });
</script>
@endsection