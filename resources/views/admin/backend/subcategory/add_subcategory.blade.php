@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
			
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('all.subcategory')}}">All Subcategory</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Subcategory</li>
                </ol>
            </nav>
        </div>


    </div>
    <div class="card">
    <div class="card-body p-4">
        <h5 class="mb-4">Vertical Form</h5>
        <form name="myForm" id="myForm" action="{{route('store.subcategory')}}" method="post" class="row g-3" enctype="multipart/form-data">
            @csrf

            <div class="form-group col-12">
                <label for="main_category_id" class="form-label">Main Category Name</label>
                <select id="main_category_id" name="main_category_id" class="form-select form-select-lg mb-3" aria-label="Default select example">
                    <option selected="" disabled>Open this select menu</option>
                    
                        @foreach ($category as $cat)

                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>

                        @endforeach
                </select>
            </div>

            <div class="form-group col-12">
                <label for="subcategory_name" class="form-label">Subcategory Name</label>
                <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" placeholder="subcategory Name">
            </div>
        
            <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#myForm').validate({
            rules: {
                subcategory_name: {
                    required: true,
                },
                'main_category_id': {
                    required: true,
                },
            },
            messages: {
                subcategory_name: {
                    required: 'Please Enter Subcategory Name',
                },
                'main_category_id': {
                    required: 'Please Select A Main Category',
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>


@endsection