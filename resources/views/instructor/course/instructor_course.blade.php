@extends('instructor.instructor_dashboard')
@section('instructor')

<div class="page-content">
			
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Your Courses</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('add.course')}}" class="btn btn-primary px-5">Add Course</a>
            </div>
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
                            <th>Course Image</th>
                            <th>Course name</th>
                            <th>Main Category</th>
                            <th>Sub Category</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{(!empty($item->course_image) && $item->course_image !== '-1') ? asset($item->course_image)  : url('upload/no_image.jpg')}}"" alt="" style="width: 70px; height:40px">
                            </td>
                            <td>
                                {{$item->course_name}}
                            </td>
                            <td>
                                @if(isset($item['category']) && isset($item['category']['category_name']))
                                {{$item['category']['category_name']}}
                                @else
                                {{-- Handle the case when either $item or $item['category'] is null/undefined --}}
                                <p>No category name available.</p>
                                @endif
                            </td>
                            <td>
                                @if(isset($item['Subcategory']) && isset($item['Subcategory']['subcategory_name']))
                                {{$item['Subcategory']['subcategory_name']}}
                                @else
                                {{-- Handle the case when either $item or $item['category'] is null/undefined --}}
                                <p>No category name available.</p>
                                @endif
                                
                            </td>
                            <td>
                                {{$item->selling_price}}
                            </td>
                            <td>
                                {{$item->discount_price}}
                            </td>
                            <td>
                                <a href ="{{route('edit.course',$item->id)}}" class="btn btn-info" title="Edit"><i class="lni lni-eraser"></i></a> 
                                <a href ="{{route('add.course.lecture',$item->id)}}" class="btn btn-warning" title="Learning List"><i class="lni lni-list"></i></a> 
                                <a href ="{{route('delete.course',$item->id)}}" class="btn btn-danger" id="Delete"> <i class="lni lni-trash"></i></a> 
                            </td>
                            
                        </tr>
                        @endforeach 
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>

@endsection