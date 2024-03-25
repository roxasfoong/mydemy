@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')

<div class="media media-card align-items-center">
                    <div class="media-img media--img media-img-md rounded-full">    
                        @if(Auth::user()->role == 'admin')
                        <img class="rounded-full img-fluid" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/admin_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                        @elseif(Auth::user()->role == 'instructor')
                        <img class="rounded-full img-fluid" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/instructor_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                        @else
                        <img class="rounded-full img-fluid" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/user_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                        @endif
                        
                    </div>
                    <div class="media-body">
                        <h2 class="section__title fs-30">Welcome, {{$profileData->name}}</h2>
                    </div><!-- end media-body -->
                </div><!-- end media -->

            </div><!-- end breadcrumb-content -->
            <div class="section-block mb-5"></div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
                    <div class="setting-body">
                        <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>

                        <form method="POST" action="{{route('user.update.profile')}}" enctype="multipart/form-data" class="row pt-40px">
                        @csrf
                        <div class="media media-card align-items-center col-12">
                            <div class="media-img media-img-lg mr-4 bg-gray">
                                @if(Auth::user()->role == 'admin')
                                <img class="mr-3" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/admin_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                                @elseif(Auth::user()->role == 'instructor')
                                <img class="mr-3" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/instructor_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                                @else
                                <img class="mr-3" src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/user_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" alt="Avatar image">
                                @endif
                                
                            </div>
                            <div class="media-body">
                                <div class="file-upload-wrap file-upload-wrap-2">
                                    <input type="file" name="photo" class="multi file-upload-input with-preview" multiple>
                                    <span class="file-upload-text"><i class="la la-photo mr-2"></i>Upload a Photo</span>
                                </div><!-- file-upload-wrap -->
                                
                            </div>
                        </div><!-- end media -->
               
                            <div class="input-box col-lg-12">
                                <label class="label-text">Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name" value="{{$profileData->name}}">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-12">
                                <label class="label-text">Username</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="username" value="{{$profileData->username}}">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->

                            <div class="input-box col-lg-12">
                                <label class="label-text">Email Address</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="email" name="email" value="{{$profileData->email}}">
                                    <span class="la la-envelope input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-12">
                                <label class="label-text">Phone number</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="phone" value="{{$profileData->phone}}">
                                    <span class="la la-phone input-icon"></span>
                                </div>
                            </div><!-- end input-box -->

                            <div class="input-box col-lg-12">
                                <label class="label-text">Address</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="address" value="{{$profileData->address}}">
                                    <span class="la la-phone input-icon"></span>
                                </div>
                            </div><!-- end input-box -->

                            <div class="input-box col-lg-12 py-2">
                                <button class="btn theme-btn">Save Changes</button>
                            </div><!-- end input-box -->
                        </form>
                    </div><!-- end setting-body -->
                </div><!-- end tab-pane -->
             </div><!-- end tab-content -->

@endsection