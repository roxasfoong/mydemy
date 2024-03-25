<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Admin</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='arrow-back bx bx-arrow-back'></i>
				</div>
			 </div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
			
				<li>
					<a href="{{route('index')}}">
						<div class="parent-icon"><i class='bx bx-home-alt'></i>
						</div>
						<div class="menu-title">Home</div>
					</a>
				</li>

				<li class="menu-label">Main Menu</li>
				
				@if (Auth::user()->can('category.all')) 
				<li> 
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-category'></i>
						</div>
						<div class="menu-title">Manage Catetory</div>
					</a>
					<ul>
						<li> <a href="{{route('all.category')}}"><i class='bx bx-radio-circle'></i>All Category</a>
						</li>
						<li> <a href="{{route('all.subcategory')}}"><i class='bx bx-radio-circle'></i>All Subcategory</a>
						</li>
					</ul>
				</li>
				@endif

				@if (Auth::user()->can('instructor.status')) 
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-user'></i>
						</div>
						<div class="menu-title">Manage Instructor</div>
					</a>
					<ul>
						<li> <a href="{{route('show.all.instructor')}}"><i class='bx bx-radio-circle'></i>All Instructor</a>
						</li>
					</ul>
				</li>
				@endif

				@if (Auth::user()->can('blog.all')) 
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-book-open'></i>
						</div>
						<div class="menu-title">Manage Blog </div>
					</a>
					<ul>
						<li> <a href="{{ route('blog.category') }}"><i class='bx bx-radio-circle'></i>Blog Category </a>
						</li>
						<li> <a href="{{ route('blog.post') }}"><i class='bx bx-radio-circle'></i>Blog Post</a>
						</li>
					</ul>
				</li>
				@endif


				@if (Auth::user()->can('setting.all')) 
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-cog'></i>
						</div>
						<div class="menu-title">Manage Setting</div>
					</a>
					<ul>
						<li> <a href="{{ route('smtp.setting') }}"><i class='bx bx-radio-circle'></i>Manage SMPT</a>
						</li>
		                <li> <a href="{{ route('site.setting') }}"><i class='bx bx-radio-circle'></i>Site Setting </a>
						</li>
					</ul>
				</li>
				@endif


				@if (Auth::user()->can('course.all')) 
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-book'></i>
						</div>
						<div class="menu-title">Manage Courses</div>
					</a>
					<ul>
						<li> <a href="{{ route('admin.all.course') }}"><i class='bx bx-radio-circle'></i>All Courses</a>
						</li>
		
		
					</ul>
				</li>
				@endif


				@if (Auth::user()->can('coupon.all')) 
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-gift'></i>
						</div>
						<div class="menu-title">Manage Coupon</div>
					</a>
					<ul>
						<li> <a href="{{ route('admin.all.coupon') }}"><i class='bx bx-radio-circle'></i>All Coupon</a>
						</li>
					</ul>
				</li>
				@endif



				@if (Auth::user()->can('order.all')) 
						<li>
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon"><i class='bx bx-receipt'></i>
								</div>
								<div class="menu-title">Manage Orders</div>
							</a>
							<ul>
								<li> <a href="{{ route('admin.pending.order') }}"><i class='bx bx-radio-circle'></i>Pending Orders </a>
								</li>
								<li> <a href="{{ route('admin.confirm.order') }}"><i class='bx bx-radio-circle'></i>Confirm Orders </a>
								</li>
							</ul>
						</li>
						@endif


						@if (Auth::user()->can('review.all')) 
						<li>
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon"><i class='bx bx-star'></i>
								</div>
								<div class="menu-title">Manage Review</div>
							</a>
							<ul>
								<li> <a href="{{ route('admin.pending.review') }}"><i class='bx bx-radio-circle'></i>Pending Review </a>
								</li>
								<li> <a href="{{ route('admin.active.review') }}"><i class='bx bx-radio-circle'></i>Active Review </a>
								</li>	
							</ul>
						</li>
						@endif


						@if (Auth::user()->can('report.all')) 
						<li>
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon"><i class='bx bx-book-content'></i>
								</div>
								<div class="menu-title">Manage Report</div>
							</a>
							<ul>
								<li> <a href="{{ route('report.view') }}"><i class='bx bx-radio-circle'></i>Report View </a>
								</li>
							</ul>
						</li>
						@endif


						@if (Auth::user()->can('user.status')) 
						<li>
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon"><i class='bx bx-group'></i>
								</div>
								<div class="menu-title">Manage All User </div>
							</a>
							<ul>
								<li> <a href="{{ route('all.user') }}"><i class='bx bx-radio-circle'></i>All User </a>
								</li>
								<li> <a href="{{ route('all.instructor') }}"><i class='bx bx-radio-circle'></i>All Instructor</a>
								</li>
				
				
				
							</ul>
						</li>
						@endif
		
						@if (Auth::user()->can('role.permission.all')) 	
				<li class="menu-label">Role & Permission</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-sitemap"></i>
						</div>
						<div class="menu-title">Role & Permission</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.permission') }}"><i class='bx bx-radio-circle'></i>All Permission</a></li>
						<li> <a href="{{ route('all.roles') }}"><i class='bx bx-radio-circle'></i>All Roles</a></li>
						<li> <a href="{{ route('add.roles.permission') }}"><i class='bx bx-radio-circle'></i>Role In Permission</a></li>
						<li> <a href="{{ route('all.roles.permission') }}"><i class='bx bx-radio-circle'></i>All Role In Permission</a></li>
					</ul>
				</li>

				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-user-check"></i>
						</div>
						<div class="menu-title">Manage Admin</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.admin') }}"><i class='bx bx-radio-circle'></i>All Admin</a>
						</li> 
					</ul>
				</li>
				@endif
				<li class="menu-label">Profile</li>
				<li> 
					<a href="{{route('admin.profile')}}">
						<div class="parent-icon"><i class='bx bx-user-circle'></i>
						</div>
						<div class="menu-title">My Profile</div>
					</a>
				</li>
				<li> 
					<a href="{{route('admin.change.password')}}">
						<div class="parent-icon"><i class='bx bx-lock'></i>
						</div>
						<div class="menu-title">Change Passowrd</div>
					</a>
				</li>
				<li> 
					<a href="{{route('admin.logout')}}">
						<div class="parent-icon"><i class='bx bx-power-off'></i>
						</div>
						<div class="menu-title">Log out</div>
					</a>
				</li>
	{{-- 				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-map-alt"></i>
						</div>
						<div class="menu-title">Maps</div>
					</a>
					<ul>
						<li> <a href="map-google-maps.html"><i class='bx bx-radio-circle'></i>Google Maps</a>
						</li>
						<li> <a href="map-vector-maps.html"><i class='bx bx-radio-circle'></i>Vector Maps</a>
						</li>
					</ul>
				</li>

					<a href="https://themeforest.net/user/codervent" target="_blank">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a> --}}

				
			</ul>
			<!--end navigation-->
</div>