@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
                    <div class="setting-body">
                        <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password</h3>

                        <form method="POST" action="{{route('user.update.password')}}" enctype="multipart/form-data" class="row pt-40px">
                        @csrf

                            <div class="input-box col-lg-12">
                                <label class="label-text">Old Password</label>
                                <div class="form-group">
                                    <input type="password" name="old_password" class="form-control @error('old_password') is-valid @enderror" id="old_password" />
                                    @error('old_password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div><!-- end input-box -->

                            <div class="input-box col-lg-12">
                                <label class="label-text">New Password</label>
                                <div class="form-group">
                                    <input type="password" name="new_password" class="form-control @error('new_password') is-valid @enderror" id="new_password" />
                                    @error('new_password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div><!-- end input-box -->

                            <div class="input-box col-lg-12">
                                <label class="label-text">Name</label>
                                <div class="form-group">
                                    <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation"/>
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