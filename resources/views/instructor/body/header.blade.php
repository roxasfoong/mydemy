<header>
			<div class="topbar d-flex align-items-center justify-content-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i> 
					</div>




					  <div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							{{-- ------------Notification Bell---------------- --}}
							@php
							$ncount = Auth::user()->unreadNotifications()->count();
							@endphp 
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown"><span class="alert-count" id="notification-count">{{ $ncount }}</span>
									<i class='bx bx-bell'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
										</div>
									</a>

									@php
									$user = Auth::user();
									@endphp

									<div class="header-notifications-list">
									@forelse ($user->notifications as $notification) 

				<a class="dropdown-item" href="javascript:;" onclick="markNotificationRead('{{ $notification->id }}')">
                <div class="d-flex align-items-center">
                    <div class="notify bg-light-danger text-danger">dc
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="msg-name">{{ $notification->data['message'] }} <span class="msg-time float-end"> {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }} </span></h6>
                        <p class="msg-info">New Order</p>
                    </div>
                </div>
            </a>
            @empty
            @endforelse 
									</div>
									{{-- <a href="javascript:;">
										<div class="text-center msg-footer">
											<button class="btn btn-primary w-100">View All Notifications</button>
										</div>
									</a> --}}
								</div>
							</li>
						{{-- ------------Notification Bell---------------- --}}

						{{---------------Chat Notification---------------- --}}

							<li class="nav-item">
								<a class="nav-link position-relative" href="{{route('instructor.node.chat')}}" > <span id="messQty" class="alert-count">0</span>
									<i class='bx bx-chat'></i>
								</a>
							</li>

								<div class="dropdown-menu dropdown-menu-end"> 
									<div class="header-message-list">
									</div>
								</div>

						{{---------------Chat Notification---------------- --}}
					


						</ul>
					</div>
					@php
					$id = Auth::user()->id;
					$profileData = App\Models\User::find($id);
					@endphp
					<div class="user-box dropdown px-3">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/instructor_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" class="user-img" alt="user avatar">
							<div class="user-info">
								<p class="user-name mb-0">{{$profileData->name}}</p>
								<p class="designattion mb-0">{{$profileData->email}}</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item d-flex align-items-center" href="{{route('instructor.profile')}}"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="{{route('instructor.change.password')}}"><i class="bx bx-cog fs-5"></i><span>Change Password</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="{{route('dashboard')}}"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
							</li>
{{-- 							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-dollar-circle fs-5"></i><span>Earnings</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-download fs-5"></i><span>Downloads</span></a>
							</li> --}}
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="{{route('instructor.logout')}}"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<script>
			function markNotificationRead(notificationId){
				fetch('/mark-notification-as-read/'+notificationId,{
					method: 'POST',
					headers: {
						'Content-Type' : 'application/josn',
						'X-CSRF-TOKEN' : '{{ csrf_token() }}'
					},
					body: JSON.stringify({})
				})
				.then(response => response.json())
				.then(data => {
					document.getElementById('notification-count').textContent = data.count;
				})
				.catch(error => {
					console.log('Error',error)
				});
			}
		</script>