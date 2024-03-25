@extends('admin.admin_dashboard')
@section('admin')

			<div class="page-content">
			
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Instructor</li>
							</ol>
						</nav>
					</div>

				</div>
 
				<h6 class="mb-0 text-uppercase">DataTable Example</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
                                        <th>Sl</th>
										<th>Instructor ID</th>
										<th>Instructor Name</th>
										<th>Email</th>
										<th>Phone</th>
										{{-- <th>Status</th> --}}
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allInstructor as $key=> $item)
									<tr>
										<td>{{$key+1}}</td>
										<td>{{$item->id}}</td>
										<td>{{$item->name}}</td>
										<td>{{$item->email}}</td>
										<td>{{$item->phone}}</td>
{{-- 										<td>
                                            @if($item->status === '1')
                                            <span class="btn btn-success">Active</span>
                                            @else
                                            <span class="btn btn-danger">Inactive</span>
                                            @endif
                                        </td> --}}
										<td>
<!-- This div contains a styled checkbox switch using Bootstrap classes -->
<div class="form-check-danger form-check form-switch">
    <!-- The checkbox input with specific classes, ID, and data attributes -->
    <input class="form-check-input status-toggle" type="checkbox" id="flexSwitchCheckCheckedDanger" data-user-id="{{$item->id}}" {{$item->status ? 'checked' : '' }} style="transform: scale(1.5);">
    <!-- An empty label associated with the checkbox -->
    <label class="form-check-label" for="flexSwitchCheckCheckedDanger"></label>
</div>
										</td>
									
									</tr>
									@endforeach
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
			</div>
				
            
<!-- This script is executed when the document is ready -->
<script>
    $(document).ready(function() {
        <!-- Event listener for the 'change' event on elements with class 'status-toggle' -->
        $('.status-toggle').on('change', function() {
            <!-- Retrieving user ID and whether the switch is checked -->
            var userID = $(this).data('user-id');
            var isChecked = $(this).is(':checked');

            <!-- Making an AJAX request to update user status -->
            $.ajax({
                url: "{{route('update.user.status')}}", <!-- Laravel route to handle the request -->
                method: "POST",
                data: {
                    user_id: userID,
                    is_checked: isChecked ? 1 : 0, <!-- Converting boolean to 1 or 0 -->
                    _token: "{{csrf_token()}}" <!-- CSRF token for security -->
                },
                success: function(response) {
                    toastr.success(response.message); <!-- Display success message using toastr library -->
                },
                error: function(response) {
                    toastr.error(response.message); <!-- Display error message using toastr library -->
                }
            });
        });
    });
</script>

@endsection