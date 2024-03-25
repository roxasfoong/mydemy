@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
			
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('all.category')}}">All Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                </ol>
            </nav>
        </div>


    </div>
    <div class="card">
    <div class="card-body p-4">
        <h5 class="mb-4">Vertical Form</h5>
        <form name="myForm" id="myForm" action="{{route('update.category')}}" method="post" class="row g-3" enctype="multipart/form-data">
            @csrf
        
            <input type="hidden" name="id" value="{{$category->id}}">
            <div class="form-group col-md-12">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="category_name" id="category_name" value="{{$category->category_name}}">
            </div>
        
            <div class="form-group col-md-12">
                <label for="catImage" class="form-label">Category Image</label>
                <input id="catImage" type="file" name="image" class="form-control" />
        
                <div class="col-md-12">
                    <img id="showCategoryImage" src="{{(!empty($category->image) && $category->image !== 'image') ? url($category->image ) : url('upload/no_image.jpg')}}" alt="Category Image" class="rounded-circle p-1 bg-primary" width="90">
                </div>
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
                category_name: {
                    required: true,
                },

            },
            messages: {
                category_name: {
                    required: 'Please Enter Category Name',
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

<script type="text/javascript">
    $(document).ready(function(){
        // Attach a change event handler to the input with id 'image'
        $('#catImage').change(function(e){
            // Create a new FileReader object
            var reader = new FileReader();
        
            // Define a callback function to execute when the file has been read
            reader.onload = function(e){
                // Set the 'src' attribute of the image with id 'showCategoryImage'
                $('#showCategoryImage').attr('src', e.target.result);
            }
        
            // Read the contents of the selected file as a data URL
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

@endsection