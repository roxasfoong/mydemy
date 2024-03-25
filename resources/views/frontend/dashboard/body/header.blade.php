@php
        $siteSetting = App\Models\SiteSetting::find(1);
@endphp
<header class="header-menu-area">
    <div class="header-menu-content dashboard-menu-content pr-30px pl-30px bg-white shadow-sm">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="logo-box logo--box">
                            <a href="{{route('index')}}" class="logo"><img src="{{asset($siteSetting->logo)}}" alt="logo"></a>
                            <div class="user-btn-action">

{{--                                 <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="Search">
                                    <i class="la la-search"></i>
                                </div> --}}

{{--                                 <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="Category menu">
                                    <i class="la la-th-large"></i>
                                </div> --}}

                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="top" title="Main menu">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div><!-- end logo-box -->
                        <div class="menu-wrapper justify-content-center">
 
{{--                             <form method="post" class="mr-auto ml-0">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control form--control-gray pl-3" type="text" name="search" placeholder="Search for anything">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form> --}}

                            <div class="nav-right-button d-flex align-items-center">
                                <div class="user-action-wrap d-flex align-items-center">
                                    <div class="shop-cart course-cart pr-3 mr-3 border-right border-right-gray">
                                         <ul>
                                            
                                            <li> 
                                                <a href="{{ route('my.course') }}" class="btn btn-btn-transparent"><b>Enrolled Course</b> </a>

{{--                                                 <p class="shop-cart-btn d-flex align-items-center fs-16">
                                                    My Courses
                                                    <span class="la la-angle-down fs-13 ml-1"></span>
                                                </p>
                                                <ul class="cart-dropdown-menu after-none">
                                                    <li class="media media-card">
                                                        <a href="lesson-details.html" class="media-img">
                                                            <img class="mr-3" src="{{asset('frontend/images/small-img-3.jpg')}}" alt="Course thumbnail image">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5><a href="lesson-details.html">The Complete JavaScript Course 2021: From Zero to Expert!</a></h5>
                                                            <div class="skillbar-box pt-3">
                                                                <div class="skillbar skillbar-skillbar" data-percent="36%">
                                                                    <div class="skillbar-bar skillbar--bar bg-1"></div>
                                                                </div><!-- End Skill Bar -->
                                                            </div><!-- End skillbar-box -->
                                                        </div>
                                                    </li>
                                                   
                                                    <li>
                                                        <a href="my-courses.html" class="btn theme-btn w-100">Got to my course <i class="la la-arrow-right icon ml-1"></i></a>
                                                    </li>
                                                </ul> --}}
                                            </li>
                                        </ul> 
                                    </div><!-- end course-cart -->
                                    <div class="shop-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>
                                            <li>
                                                <a href="{{ route('mycart') }}" class="shop-cart-btn d-flex align-items-center">
                                                    <i class="la la-shopping-cart"></i>
                                                    <span class="product-count" id="cartQty"></span>
                                                </a>
                                                    
                                                <ul class="cart-dropdown-menu">
                                                    <div id="miniCart">
                                                    </div>
                                                    <br><br>
                                                    <li class="media media-card">
                                                        <div class="media-body fs-16">
                                                            <p class="text-black font-weight-semi-bold lh-18">Total: $<span class="cart-total" id="cartSubTotal"> </span>  </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('mycart') }}" class="btn theme-btn w-100">Go to cart <i class="la la-arrow-right icon ml-1"></i></a>
                                                    </li>
                                                </ul>
            
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->
                                    <div class="shop-cart wishlist-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>
                                            <li>
                                                <a href="{{route('user.wishlist')}}" class="shop-cart-btn d-flex align-items-center">
                                                    <i class="la la-heart-o"></i>
                                                    <span class="product-count" id="hWishQty">0</span>
                                                </a>
                                                    
                                            {{--     <ul class="cart-dropdown-menu">
                                                    <div id="miniCart">
                                                    </div>
                                                    <br><br>
                                                    <li class="media media-card">
                                                        <div class="media-body fs-16">
                                                            <p class="text-black font-weight-semi-bold lh-18">Total: $<span class="cart-total" id="cartSubTotal"> </span>  </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('mycart') }}" class="btn theme-btn w-100">Go to cart <i class="la la-arrow-right icon ml-1"></i></a>
                                                    </li>
                                                </ul> --}}
            
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->

{{--                                     <div class="shop-cart notification-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>
                                            <li>
                                                <p class="shop-cart-btn">
                                                    <i class="la la-bell"></i>
                                                    <span class="dot-status bg-1"></span>
                                                </p>
                                                <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center justify-content-between">
                                                        <h4>Notifications</h4>
                                                        <span class="ribbon fs-14">18</span>
                                                    </li>
                                                    <li>
                                                        <div class="notification-body">
                                                            <a href="dashboard.html" class="media media-card align-items-center">
                                                                <div class="icon-element icon-element-sm flex-shrink-0 bg-1 mr-3 text-white">
                                                                    <i class="la la-bolt"></i>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>Your resume updated!</h5>
                                                                    <span class="d-block lh-18 pt-1 text-gray fs-13">1 hour ago</span>
                                                                </div>
                                                            </a>
                                                            <a href="dashboard.html" class="media media-card align-items-center">
                                                                <div class="icon-element icon-element-sm flex-shrink-0 bg-2 mr-3 text-white">
                                                                    <i class="la la-lock"></i>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>You changed password</h5>
                                                                    <span class="d-block lh-18 pt-1 text-gray fs-13">November 12, 2019</span>
                                                                </div>
                                                            </a>
                                                            <a href="dashboard.html" class="media media-card align-items-center">
                                                                <div class="icon-element icon-element-sm flex-shrink-0 bg-3 mr-3 text-white">
                                                                    <i class="la la-user"></i>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>Your account has been created successfully</h5>
                                                                    <span class="d-block lh-18 pt-1 text-gray fs-13">November 12, 2019</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li class="menu-heading-block">
                                                        <a href="dashboard.html" class="btn theme-btn w-100">Show All Notifications <i class="la la-arrow-right icon ml-1"></i></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart --> --}}

                                    <div class="shop-cart wishlist-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>
                                            <li>
                                                <a href="{{route('live.Node.chat')}}" class="shop-cart-btn d-flex align-items-center">
                                                    <i class="la la-comment"></i>
                                                    <span class="product-count" id="messQty">0</span>
                                                </a>
                                                    
                                            {{--     <ul class="cart-dropdown-menu">
                                                    <div id="miniCart">
                                                    </div>
                                                    <br><br>
                                                    <li class="media media-card">
                                                        <div class="media-body fs-16">
                                                            <p class="text-black font-weight-semi-bold lh-18">Total: $<span class="cart-total" id="cartSubTotal"> </span>  </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('mycart') }}" class="btn theme-btn w-100">Go to cart <i class="la la-arrow-right icon ml-1"></i></a>
                                                    </li>
                                                </ul> --}}
            
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->
                                
{{--                                     <div class="shop-cart notification-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>
                                            <p class="shop-cart-btn position-relative">
                                                <a class="text-danger" href="{{route('live.Node.chat')}}" > 
                                                    <i class="la la-comment"></i>
                                                    <span id="messQty" class="alert-count">0</span>
                                                </a>
                                            </p>
                                        </ul>
                                    </div><!-- end shop-cart --> --}}

                                    <div class="shop-cart user-profile-cart">
                                        <ul>
                                            <li>
                                                <div class="shop-cart-btn">
                                                    <div class="avatar-xs">
                                                        @if(Auth::user()->role == 'admin')
                                                        <img class="rounded-full img-fluid" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/admin_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                                                        @elseif(Auth::user()->role == 'instructor')
                                                        <img class="rounded-full img-fluid" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/instructor_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                                                        @else
                                                        <img class="rounded-full img-fluid" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/user_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                                                        @endif
                                                    </div>
                                                    {{-- <span class="dot-status bg-1"></span> --}}
                                                </div>
                                                <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center">
                                                        <a href="teacher-detail.html" class="avatar-sm flex-shrink-0 d-block">
                                                            @if(Auth::user()->role == 'admin')
                                                            <img class="rounded-full img-fluid" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/admin_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                                                            @elseif(Auth::user()->role == 'instructor')
                                                            <img class="rounded-full img-fluid" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/instructor_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                                                            @else
                                                            <img class="rounded-full img-fluid" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/user_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                                                            @endif
                                                        </a>
                                                        <div class="ml-2">
                                                            <h4><a href="teacher-detail.html" class="text-black">{{$profileData->name}}</a></h4>
                                                            <span class="d-block fs-14 lh-20">{{$profileData->email}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="theme-picker d-flex align-items-center justify-content-center lh-40">
                                                            <button class="theme-picker-btn dark-mode-btn w-100 font-weight-semi-bold justify-content-center" title="Dark mode">
                                                                <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                                                </svg>
                                                                Dark Mode
                                                            </button>
                                                            <button class="theme-picker-btn light-mode-btn w-100 font-weight-semi-bold justify-content-center" title="Light mode">
                                                                <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
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
                                                                Light Mode
                                                            </button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <ul class="generic-list-item">

 {{--                                                            <li><div class="section-block"></div></li>
                                                            <li>
                                                                <a href="dashboard-settings.html">
                                                                    <i class="la la-gear mr-1"></i> Settings
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="dashboard-purchase-history.html">
                                                                    <i class="la la-history mr-1"></i> Purchase history
                                                                </a>
                                                            </li> --}}

                                                            <li><div class="section-block"></div></li>
                                                            @if(Auth::user()->role =='admin')
                                                            <li>
                                                                <a href="{{route('admin.profile')}}">
                                                                    <i class="la la-user mr-1"></i> My profile
                                                                </a>
                                                            </li>
                                                            @elseif(Auth::user()->role =='instructor')
                                                            <li>
                                                                <a href="{{route('instructor.profile')}}">
                                                                    <i class="la la-user mr-1"></i> My profile
                                                                </a>
                                                            </li>
                                                            @else
                                                            <li>
                                                                <a href="{{route('user.profile')}}">
                                                                    <i class="la la-user mr-1"></i> My profile
                                                                </a>
                                                            </li>
                                                            @endif
                                                            <li>
                                                                <a href="{{route('user.change.password')}}">
                                                                    <i class="la la-lock mr-1"></i> Change Password
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{route('dashboard')}}">
                                                                    <i class="la la-home mr-1"></i> Dashboard
                                                                </a>
                                                            </li>
                        {{--                                     <li>
                                                                <a href="dashboard-settings.html">
                                                                    <i class="la la-edit mr-1"></i> Edit profile
                                                                </a>
                                                            </li>
                                                            <li><div class="section-block"></div></li>
                                                            <li>
                                                                <a href="#">
                                                                    <i class="la la-question mr-1"></i> Help
                                                                </a>
                                                            </li> --}}

                                                            <li>
                                                                @if(Auth::user()->role == 'admin')
                                                                <a href="{{route('admin.logout')}}">
                                                                    <i class="la la-power-off mr-1"></i> Logout
                                                                </a>
                                                                @else
                                                                <a href="{{route('user.logout')}}">
                                                                    <i class="la la-power-off mr-1"></i> Logout
                                                                </a>
                                                                @endif
                                                            </li>

                                                            <li><div class="section-block"></div></li>

{{--                                                             <li>
                                                                <a href="#" class="position-relative">
                                                                    <span class="fs-17 font-weight-semi-bold d-block">Aduca for Business</span>
                                                                    <span class="lh-20 d-block fs-14 text-gray">Bring learning to your company</span>
                                                                    <span class="position-absolute top-0 right-0 mt-3 mr-3 fs-18 text-gray">
                                                                    <i class="la la-external-link"></i>
                                                                </span>
                                                                </a>
                                                            </li> --}}

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->
                                </div>
                            </div><!-- end nav-right-button -->
                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->



    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <ul class="generic-list-item off-canvas-menu-list off--canvas-menu-list pt-35px">
            <div class="logo-box px-4">
                <a href="{{route('index')}}" class="logo"><img src="{{'/'. $siteSetting->logo}}" alt="logo"></a>
            </div>
            <li>
                <a href="{{ route('index') }}" style="font-size:1.2rem;">
                    <i class="la la-home mr-2"></i> Home
                </a>
            </li>
            <li><a href="{{ route('my.course') }}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg> Enrolled Courses</a></li>
            @if(Auth::user()->role =='admin')
            <li><a href="{{ route('admin.profile')}}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/></svg> My Profile</a></li>
            @elseif(Auth::user()->role =='instructor')
            <li><a href="{{ route('instructor.profile')}}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/></svg> My Profile</a></li>
            @else
            <li><a href="{{ route('user.profile')}}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/></svg> My Profile</a></li>
            @endif
            <li><a href="{{ route('user.wishlist') }}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/></svg> Wishlist <span class="badge badge-info p-1 ml-2" id="mWishQty">0</span> </a></li>
            <li><a href="{{ route('live.Node.chat') }}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/></svg> Live Chat <span class="badge badge-info p-1 ml-2" id="mMessQty">0</span></a></li>
            {{-- <li><a href="dashboard-reviews.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/></svg> Reviews</a></li> --}}
            
            <li>
                <a href="{{ route('mycart') }}">
                    <i class="la la-shopping-bag mr-2"></i> My Cart
                </a>
            </li>
            
            <li>
                <a href="{{ route('user.change.password') }}">
                    <i class="la la-lock mr-2"></i> Change Password
                </a>
            </li>
            @if(Auth::user()->role =='admin')
            <li><a href="{{route('admin.logout')}}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 3h-2v10h2V3zm4.83 2.17l-1.42 1.42C17.99 7.86 19 9.81 19 12c0 3.87-3.13 7-7 7s-7-3.13-7-7c0-2.19 1.01-4.14 2.58-5.42L6.17 5.17C4.23 6.82 3 9.26 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-2.74-1.23-5.18-3.17-6.83z"/></svg> Log out</a></li>
            @else
            <li><a href="{{route('user.logout')}}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 3h-2v10h2V3zm4.83 2.17l-1.42 1.42C17.99 7.86 19 9.81 19 12c0 3.87-3.13 7-7 7s-7-3.13-7-7c0-2.19 1.01-4.14 2.58-5.42L6.17 5.17C4.23 6.82 3 9.26 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-2.74-1.23-5.18-3.17-6.83z"/></svg> Log out</a></li>
            @endif
           
            
        </ul>
       {{--  <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        <h4 class="off-canvas-menu-heading pt-90px">Alerts</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1 pb-2 border-bottom border-bottom-gray">
            <li><a href="dashboard.html">Notifications</a></li>
            <li><a href="dashboard-message.html">Messages</a></li>
            <li><a href="my-courses.html">Wishlist</a></li>
            <li><a href="shopping-cart.html">My cart</a></li>
        </ul>
        <h4 class="off-canvas-menu-heading pt-20px">Account</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1 pb-2 border-bottom border-bottom-gray">
            <li><a href="dashboard-settings.html">Account settings</a></li>
            <li><a href="dashboard-purchase-history.html">Purchase history</a></li>
        </ul>
        <h4 class="off-canvas-menu-heading pt-20px">Profile</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1 pb-2 border-bottom border-bottom-gray">
            <li><a href="student-detail.html">Public profile</a></li>
            <li><a href="dashboard-settings.html">Edit profile</a></li>
            <li><a href="index.html">Log out</a></li>
        </ul>
        <h4 class="off-canvas-menu-heading pt-20px">More from Aduca</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1">
            <li><a href="for-business.html">Aduca for Business</a></li>
            <li><a href="#">Get the app</a></li>
            <li><a href="invite.html">Invite friends</a></li>
            <li><a href="contact.html">Help</a></li>
        </ul>
        <div class="theme-picker d-flex align-items-center justify-content-center mt-4 px-3">
            <button class="theme-picker-btn dark-mode-btn btn theme-btn-sm theme-btn-white w-100 font-weight-semi-bold justify-content-center" title="Dark mode">
                <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
                Dark Mode
            </button>
            <button class="theme-picker-btn light-mode-btn btn theme-btn-sm theme-btn-white w-100 font-weight-semi-bold justify-content-center" title="Light mode">
                <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
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
                Light Mode
            </button> 
        </div>--}}



    </div><!-- end off-canvas-menu -->
    <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
        <div class="off-canvas-menu-close cat-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        <h4 class="off-canvas-menu-heading pt-90px">Learn</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1 pb-2 border-bottom border-bottom-gray">
            <li><a href="my-courses.html">My learning</a></li>
        </ul>
        <h4 class="off-canvas-menu-heading pt-20px">Categories</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1">
            <li>
                <a href="course-grid.html">Development</a>
                <ul class="sub-menu">
                    <li><a href="#">All Development</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Mobile Apps</a></li>
                    <li><a href="#">Game Development</a></li>
                    <li><a href="#">Databases</a></li>
                    <li><a href="#">Programming Languages</a></li>
                    <li><a href="#">Software Testing</a></li>
                    <li><a href="#">Software Engineering</a></li>
                    <li><a href="#">E-Commerce</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">business</a>
                <ul class="sub-menu">
                    <li><a href="#">All Business</a></li>
                    <li><a href="#">Finance</a></li>
                    <li><a href="#">Entrepreneurship</a></li>
                    <li><a href="#">Strategy</a></li>
                    <li><a href="#">Real Estate</a></li>
                    <li><a href="#">Home Business</a></li>
                    <li><a href="#">Communications</a></li>
                    <li><a href="#">Industry</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">IT & Software</a>
                <ul class="sub-menu">
                    <li><a href="#">All IT & Software</a></li>
                    <li><a href="#">IT Certification</a></li>
                    <li><a href="#">Hardware</a></li>
                    <li><a href="#">Network & Security</a></li>
                    <li><a href="#">Operating Systems</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Finance & Accounting</a>
                <ul class="sub-menu">
                    <li><a href="#"> All Finance & Accounting</a></li>
                    <li><a href="#">Accounting & Bookkeeping</a></li>
                    <li><a href="#">Cryptocurrency & Blockchain</a></li>
                    <li><a href="#">Economics</a></li>
                    <li><a href="#">Investing & Trading</a></li>
                    <li><a href="#">Other Finance & Economics</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">design</a>
                <ul class="sub-menu">
                    <li><a href="#">All Design</a></li>
                    <li><a href="#">Graphic Design</a></li>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Design Tools</a></li>
                    <li><a href="#">3D & Animation</a></li>
                    <li><a href="#">User Experience</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Personal Development</a>
                <ul class="sub-menu">
                    <li><a href="#">All Personal Development</a></li>
                    <li><a href="#">Personal Transformation</a></li>
                    <li><a href="#">Productivity</a></li>
                    <li><a href="#">Leadership</a></li>
                    <li><a href="#">Personal Finance</a></li>
                    <li><a href="#">Career Development</a></li>
                    <li><a href="#">Parenting & Relationships</a></li>
                    <li><a href="#">Happiness</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Marketing</a>
                <ul class="sub-menu">
                    <li><a href="#">All Marketing</a></li>
                    <li><a href="#">Digital Marketing</a></li>
                    <li><a href="#">Search Engine Optimization</a></li>
                    <li><a href="#">Social Media Marketing</a></li>
                    <li><a href="#">Branding</a></li>
                    <li><a href="#">Video & Mobile Marketing</a></li>
                    <li><a href="#">Affiliate Marketing</a></li>
                    <li><a href="#">Growth Hacking</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Health & Fitness</a>
                <ul class="sub-menu">
                    <li><a href="#">All Health & Fitness</a></li>
                    <li><a href="#">Fitness</a></li>
                    <li><a href="#">Sports</a></li>
                    <li><a href="#">Dieting</a></li>
                    <li><a href="#">Self Defense</a></li>
                    <li><a href="#">Meditation</a></li>
                    <li><a href="#">Mental Health</a></li>
                    <li><a href="#">Yoga</a></li>
                    <li><a href="#">Dance</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Photography</a>
                <ul class="sub-menu">
                    <li><a href="#">All Photography</a></li>
                    <li><a href="#">Digital Photography</a></li>
                    <li><a href="#">Photography Fundamentals</a></li>
                    <li><a href="#">Commercial Photography</a></li>
                    <li><a href="#">Video Design</a></li>
                    <li><a href="#">Photography Tools</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- end off-canvas-menu -->
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" class="flex-grow-1 mr-3">
                <div class="form-group mb-0">
                    <input class="form-control form--control pl-3" type="text" name="search" placeholder="Search for anything">
                    <span class="la la-search search-icon"></span>
                </div>
            </form>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
        </div>
    </div><!-- end mobile-search-form -->
    <div class="body-overlay"></div>
</header><!-- end header-menu-area -->