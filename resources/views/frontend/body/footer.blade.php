@php
    $setting = App\Models\SiteSetting::find(1);
    $categories = App\Models\Category::orderBy('category_name', 'asc')->take(6)->get();
    $courses = App\Models\Course::inRandomOrder()->orderBy('course_name', 'asc')->take(4)->get();
@endphp

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
                    <p class="copy-desc"> {{ $setting->copyright }}</p>
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