@extends('admin.admin_dashboard')
@section('admin')

			<div class="page-content">
			
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Subcategory</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('add.subcategory')}}" class="btn btn-primary px-5">Add Subcategory</a>
						</div>
					</div>
				</div>

				<h6 class="mb-0 text-uppercase">List of All Subcategory</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl</th>
										<th>Main Category Name</th>
										<th>SubCategory Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($subcategory as $key => $item)
   									{{-- Loop content here --}}
									   <tr>
										<td>{{$key+1}}</td>
										<td>
											
											@if(isset($item['category']) && isset($item['category']['category_name']))
											{{$item['category']['category_name']}}
											@else
											{{-- Handle the case when either $item or $item['category'] is null/undefined --}}
											<p>No category name available.</p>
											@endif
											
										</td>
										<td>
											{{$item->subcategory_name}}
										</td>
										<td>
											<a href ="{{route('edit.category',$item->id)}}" class="btn btn-info px-5">Edit Category</a> 
											<a href ="{{route('delete.subcategory',$item->id)}}" class="btn btn-danger px-5" id="delete" >Delete Category</a> 
										</td>
									
									</tr>
									@empty
    								{{-- Content to display when the loop is empty --}}
									<tr>
										<td>No SubCategory</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									@endforelse
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
			</div>
					
@endsection