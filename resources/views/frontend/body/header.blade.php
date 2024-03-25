@php
    $setting = App\Models\SiteSetting::find(1);
@endphp
<header class="header-menu-area bg-white">
    <div class="header-top pr-150px pl-150px border-bottom border-bottom-gray py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i class="la la-phone mr-1"></i><a href="tel:00123456789"> {{ $setting->phone }}</a></li>
                            <li class="d-flex align-items-center"><i class="la la-envelope-o mr-1"></i><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></li>
                        </ul>
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">
                        <div class="theme-picker d-flex align-items-center">
                            <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
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

                      


                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">
                            @auth
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i class="la la-sign-in mr-1"></i><a href="{{route('dashboard')}}"> Dashboard</a></li>
                            @if(Auth::user()->role == 'admin')
                            <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a href="{{route('admin.logout')}}"> Log out</a></li>
                            @else
                            <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a href="{{route('user.logout')}}"> Log out</a></li>
                            @endif
                            @else
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i class="la la-sign-in mr-1"></i><a href="{{route('login')}}"> Login</a></li>
                            <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a href="{{route('register')}}"> Register</a></li>
    
                            @endauth
                        </ul>
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-top -->
    <div class="header-menu-content pr-150px pl-150px bg-white">
        <div class="container-fluid">
            <div class="main-menu-content">
                <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{ url('/') }}" class="logo"><img src="{{ asset($setting->logo)}}" alt="logo"></a>
                            <div class="user-btn-action">

{{--                                 <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="Search">
                                    <i class="la la-search"></i>
                                </div> --}}
                                <div class="off-canvas-menu-toggle icon-element icon-element-sm shadow-sm mr-2">
                                    <a href="{{ route('mycart') }}" class="text-dark"><i class="la la-shopping-cart"></i></a>
                                </div>
                                <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="Category menu">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="top" title="Main menu">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-2 -->
                    @php
                    $categories = App\Models\Category::orderBy('category_name','ASC')->get();
                @endphp
                
                <div class="col-lg-10">
                    <div class="menu-wrapper justify-content-center">
                        <div class="menu-category mr-3">
                            <ul>
                                <li>
                                    <a href="{{route('show.all.category')}}">Categories <i class="la la-angle-down fs-12"></i></a>
                                    <ul class="cat-dropdown-menu">
                
                                        @foreach ($categories as $cat)
                        @php
                        $subcategories = App\Models\SubCategory::where('main_category_id',$cat->id)->get();    
                        @endphp                
                                        <li>
                                            <a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}">{{ $cat->category_name }}<i class="la la-angle-right"></i></a>
                                            <ul class="sub-menu">
                                                @foreach ($subcategories as $subcat)
                                                <li><a href="{{ url('subcategory/'.$subcat->id.'/'.$subcat->subcategory_slug) }}">{{ $subcat->subcategory_name }}</a></li> 
                                                @endforeach
                                            </ul>
                                        </li> 
                                        @endforeach
                
                                    </ul>
                                </li> 
                            </ul>
                        </div><!-- end menu-category -->
                            {{----------------------------Search Course Function-------------------------------}}
                        {{-- <form method="post">
                            <div class="form-group mb-0">
                                <input class="form-control form--control pl-3" type="text" name="search" placeholder="Search for anything">
                                <span class="la la-search search-icon"></span>
                            </div>
                        </form> --}}
                            {{--------------Search Course Function---------------------- --}}
                        <nav class="main-menu">
                            <ul>

                                <li>
                                    <a href="{{route('my.course')}}">Enrolled Courses</a>
                                </li>
                
                                <li>
                                    <a href="{{ route('blog') }}">blog  </a>
                
                                </li>
                            </ul><!-- end ul -->
                        </nav><!-- end main-menu -->

                                    {{-- Wishlist Area --}}
                        <div class="shop-cart mr-4">
                            <ul>
                                <li>
                                    <a href="{{route('user.wishlist')}}" class="shop-cart-btn d-flex align-items-center">
                                        <i class="la la-heart-o"></i>
                                        <span class="product-count" id="hWishQty">0</span>
                                    </a>
                               
                                </li>
                            </ul>
                        </div><!-- end shop-cart -->
                                    {{-- Wishlist Area --}}

                        <div class="shop-cart mr-4">
                            <ul>
                                <li>
                                    <p class="shop-cart-btn d-flex align-items-center">
                                        <i class="la la-shopping-cart"></i>
                                        <span class="product-count" id="cartQty"></span>
                                    </p>
                                        
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

                        {{-- ----------Chat Notification---------------- --}}
                        @php
                                $currentUser = auth()->user();
                        @endphp

                        @if($currentUser)

                                @if($currentUser->role == 'instructor')
                                <div class="shop-cart mr-4">
                                    <ul>
                                        <li>
                                            <a href="{{route('instructor.node.chat')}}" class="shop-cart-btn d-flex align-items-center">
                                                <i class="la la-comment"></i>
                                                <span class="product-count" id="messQty">0</span>
                                            </a>
                                       
                                        </li>
                                    </ul>
                                </div><!-- end shop-cart -->

                                @elseif($currentUser->role == 'user')
                                <div class="shop-cart mr-4">
                                    <ul>
                                        <li>
                                            <a href="{{route('live.Node.chat')}}" class="shop-cart-btn d-flex align-items-center">
                                                <i class="la la-comment"></i>
                                                <span class="product-count" id="messQty">0</span>
                                            </a>
                                       
                                        </li>
                                    </ul>
                                </div><!-- end shop-cart -->

                                @else

                                @endif
                        @else

                        <div class="shop-cart mr-4">
                            <ul>
                                <li>
                                    <a href="{{route('login')}}" class="shop-cart-btn d-flex align-items-center">
                                        <i class="la la-comment"></i>
                                        <span class="product-count" id="messQty">0</span>
                                    </a>
                               
                                </li>
                            </ul>
                        </div><!-- end shop-cart -->

                        @endif
                       
                        {{-- ----------Chat Notification---------------- --}}
                        @auth
                        <div class="nav-right-button">
                            <a href="{{route('dashboard')}}" class="btn theme-btn d-none d-lg-inline-block"><i class="la la-user-plus mr-1"></i> Dashboard </a>
                        </div><!-- end nav-right-button -->
                        @else
                        <div class="nav-right-button">
                            <a href="{{route('login')}}" class="btn theme-btn d-none d-lg-inline-block"><i class="la la-user-plus mr-1"></i> Login </a>
                        </div><!-- end nav-right-button -->
                        @endauth
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left">
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
            <a href="{{route('dashboard')}}"> Dashboard</a>
            </li>
            <li>
                <a href="{{route('mycart')}}"> Cart</a>
                </li>
            <li>
                <a href="{{route('my.course')}}">Enrolled Courses</a>
            </li>

           
            <li>
                <a href="{{ route('blog') }}">Blog  </a>

            </li>
        <li>
            @guest
            <a href="{{route('login')}}"> Log In</a>
            @else
            @if(Auth::user()->role == 'admin')
            <a href="{{route('admin.logout')}}"> Log out</a>
            @else
            <a href="{{route('user.logout')}}"> Log out</a>
            @endif

            @endguest
            
        </li>
        </ul>
    </div><!-- end off-canvas-menu -->
    <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
        <div class="off-canvas-menu-close cat-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" >
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            @forelse($categories as $cat)

            <li>
                <a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}">{{ $cat->category_name }}</a>
                <ul class="sub-menu">
                    @forelse($subcategories as $subcat)

                    <li><a href="{{ url('subcategory/'.$subcat->id.'/'.$subcat->subcategory_slug) }}">{{ $subcat->subcategory_name }}</a></li> 
                    @empty
                    @endforelse
                </ul>
            </li>

            @empty

            @endforelse

        </ul>
    </div><!-- end off-canvas-menu -->

{{--     <div class="mobile-search-form">
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
    </div><!-- end mobile-search-form --> --}}

    <div class="body-overlay"></div>
</header><!-- end header-menu-area -->