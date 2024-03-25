
@php

$id = Auth::user()->id;
$instructorId = App\Models\User::find($id);
$status = $instructorId->status;
$siteSetting = App\Models\SiteSetting::find(1);
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset($siteSetting->logo) }}" class="logo-icon" alt="logo icon" style="width: 60px; height: 60px;">
				</div>
				<div>
					<h4 class="logo-text">Instructor</h4>
				</div>
			 </div>

			<!--navigation-->
			<ul class="metismenu" id="menu">
			
				<li>
					<a href="{{route('index')}}">
						<div class="parent-icon"><i class='bx bx-home-alt'></i>
						</div>
						<div class="menu-title">Homepage</div>
					</a>
				</li>
@if($status === '1')
				<li>

					<ul>
						<li> <a href="app-emailbox.html"><i class='bx bx-radio-circle'></i>Email</a>
						</li>
						<li> <a href="app-chat-box.html"><i class='bx bx-radio-circle'></i>Chat Box</a>
						</li>
						<li> <a href="app-file-manager.html"><i class='bx bx-radio-circle'></i>File Manager</a>
						</li>
						<li> <a href="app-contact-list.html"><i class='bx bx-radio-circle'></i>Contatcs</a>
						</li>
						<li> <a href="app-to-do.html"><i class='bx bx-radio-circle'></i>Todo List</a>
						</li>
						<li> <a href="app-invoice.html"><i class='bx bx-radio-circle'></i>Invoice</a>
						</li>
						<li> <a href="app-fullcalender.html"><i class='bx bx-radio-circle'></i>Calendar</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">Menu</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-book'></i>
						</div>
						<div class="menu-title">Course Management</div>
					</a>
					<ul>
						<li> <a href="{{route('show.instructor.course')}}"><i class='bx bx-radio-circle'></i>All Your Courses</a>
						</li>
						<li> <a href="{{route('add.course')}}"><i class='bx bx-radio-circle'></i>Add Course</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="{{ route('instructor.all.order') }}">
						<div class="parent-icon"><i class='bx bx-receipt'></i>
						</div>
						<div class="menu-title">Orders</div>
					</a>
				
				</li>

{{-- 				<li>
					<a href="{{ route('instructor.all.question') }}">
						<div class="parent-icon"><i class='bx bx-question-mark'></i>
						</div>
						<div class="menu-title">Question</div>
					</a>
				</li> --}}

{{-- 				<li>
					<a href="{{ route('instructor.all.coupon') }}">
						<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
						</div>
						<div class="menu-title">Coupon</div>
					</a>
			
				</li> --}}
				
				<li>
					<a href="{{ route('instructor.all.review') }}">
						<div class="parent-icon"><i class='bx bx-star'></i>
						</div>
						<div class="menu-title">Course Reivew</div>
					</a>

				</li>




							
			
							<li>
								<a href="{{ route('instructor.node.chat') }}"> 
									<div class="parent-icon"><i class='bx bx-chat'></i>
									</div>
									<div class="menu-title">Live Chat </div>
									
								</a>
								
							</li>

							<li>
								<a href="{{ route('instructor.profile')}}"> 
									<div class="parent-icon"><i class='bx bx-user'></i>
									</div>
									<div class="menu-title">My Profile </div>
									
								</a>
								
							</li>

							<li>
								<a href="{{ route('instructor.change.password') }}"> 
									<div class="parent-icon"><i class='bx bx-lock'></i>
									</div>
									<div class="menu-title">Change Password</div>
									
								</a>
								
							</li>

							<li>
								<a href="{{ route('instructor.logout') }}"> 
									<div class="parent-icon"><i class='bx bx-power-off'></i>
									</div>
									<div class="menu-title">Log Out</div>
									
								</a>
								
							</li>
			</ul>


@else	

@endif
					
			<!--end navigation-->
		</div>