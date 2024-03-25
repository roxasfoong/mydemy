<header>
	<div class="topbar d-flex align-items-center justify-content-center">
		<nav class="navbar navbar-expand gap-3">

			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>

			  <div class="top-menu ms-auto">
					<ul class="navbar-nav align-items-center gap-1"> 
						<li class="nav-item dropdown dropdown-large">
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-notifications-list">								
									</div>
								</div>
						</li> 
 						<li class="nav-item dropdown dropdown-large">
					    	<div class="dropdown-menu dropdown-menu-end">
								<div class="header-message-list">
								</div>
							</div>
						</li>  
					</ul>
				</div> 
					 
					@php
					$id = Auth::user()->id;
					$profileData = App\Models\User::find($id);
					@endphp
					<div class="user-box dropdown px-3" style="min-width: 200px;">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{(!empty($profileData->photo) && $profileData->photo !== 'photo') ? url('upload/admin_images/'. $profileData->photo ) : url('upload/no_image.jpg')}}" class="user-img" alt="user avatar">
							<div class="user-info">
								<p class="user-name mb-0">{{$profileData->name}}</p>
								<p class="designattion mb-0">{{$profileData->email}}</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item d-flex align-items-center" href="{{route('admin.profile')}}"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="{{route('admin.change.password')}}"><i class="bx bx-cog fs-5"></i><span>Change Password</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="{{route('dashboard')}}"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="{{url('admin/logout')}}"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
							</li>
						</ul>
			</div>

		</nav>
	</div>


</header>

<script>
	document.addEventListener('DOMContentLoaded', function() {

		document.querySelector('.mobile-toggle-menu').addEventListener('click', function() {
			document.querySelector('.wrapper').classList.toggle('toggled');
		});

		document.querySelector('.overlay.toggle-icon').addEventListener('click', function() {
			document.querySelector('.wrapper').classList.remove('toggled');
		});

		document.querySelector('.arrow-back').addEventListener('click', function() {
			document.querySelector('.wrapper').classList.remove('toggled');
		});
		

	});
</script>