@extends('instructor.instructor_dashboard')
@section('instructor')

<div class="page-content">
			
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Add New Course</li>
                </ol>
            </nav>
        </div>
 

    </div>
  <div class="card">
     <div class="card-body p-4">
        <h5 class="mb-4">Vertical Form</h5>
        <form name="myForm" id="myForm" action="{{route('store.course')}}" method="post" class="row g-3" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group col-md-12">
                <label for="course_tittle" class="form-label">Course Tittle</label>
                <input type="text" class="form-control" name="course_tittle" id="course_tittle" placeholder="Course Tittle">
            </div>
          
            
            <div class="form-group col-md-12">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control" name="course_name" id="course_name" placeholder="Course name">
            </div>
            
           
            <div class="form-group row col-md-12 mt-3">
                <label for="course_image" class="form-label"><b>Course Image</b></label>
                <div class="col-md-6 mt-3">
                    <input id="course_image" type="file" name="course_image" class="form-control" />
                </div>                    
                <div class="col-md-6">
                    <img name="showCourseImage" id="showCourseImage" src="{{asset('upload/no_image.jpg')}}" class="img-fluid" alt="course_image">
                </div>  
            </div>
       
                {{-- 
                <div class="form-group col-md-12">
                    <label for="video" class="form-label">Course Intro Video</label>
                    <input id="video" type="file" name="video" class="form-control" accept="video/mp4,video/webm" />
                    <img id="showCategoryImage" src="{{url('upload/no_image.jpg')}}" alt="Category Image" class="rounded-circle p-1 bg-primary" width="90">
                </div> --}}

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="main_category_id" class="form-label">Main Category Name</label>
                        <select id="main_category_id" name="main_category_id" class="form-select form-select-lg mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select menu</option>
                                @foreach ($category as $cat)
        
                                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
        
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subcategory_id" class="form-label">Sub Category Name</label>
                        <select id="subcategory_id" name="subcategory_id" class="form-select form-select-lg mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select menu</option>

                        </select>
                    </div>
                </div>
               
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control" name="duration" id="duration" placeholder="Course Duration">
                    </div>
                    <div class="col-md-6">
                        <label for="resources" class="form-label">Resources</label>
                        <input name="resources" type="text" class="form-control"  id="resources" placeholder="resources">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="selling_price" class="form-label">Course Price</label>
                        <input type="text" class="form-control" name="selling_price" id="selling_price" placeholder="Course Price">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="discount_price" class="form-label">Discount Price</label>
                        <input type="text" class="form-control" name="discount_price" id="discount_price" placeholder="Discount Price">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="certificate" class="form-label">Certificate</label>
                        <select id="certificate" name="certificate" class="form-select form-select-lg mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select menu</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="certificate" class="form-label">Course Level</label>
                        <select id="certificate" name="level" class="form-select form-select-lg mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select menu</option>
                            <option value="1">Beginner</option>
                            <option value="2">intermediate</option>
                            <option value="3">Advance</option>
                            <option value="4">All</option>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                 <div class="col-md-12">
                    {{-- <label for="input11" class="form-label">Course Prerequisite</label> 
                    <textarea name="prerequisites" class="form-control" id="input11" placeholder="Course Prerequisite ..." rows="3"></textarea> --}}
                    <label for="myeditorinstance" class="form-label">Course Prerequisite</label> 
                    {{-- (found from excise > form-elemts or bootstrap 5 documentation) --}}
                    <textarea id="myeditorinstance" name="prerequisites"></textarea>
                 </div>
                </div>

              
                    <div class="form-group col-md-12">
                      {{--  <label for="description" class="form-label">Course Description</label> 
                       <textarea name="description" class="form-control" id="description" placeholder="description ..." rows="6"></textarea> --}}
                       <label for="myeditorinstance" class="form-label">Course Description</label> 
                       {{-- (found from excise > form-elemts or bootstrap 5 documentation) --}}
                       <textarea id="myeditorinstance" name="description"></textarea>
                    </div>
                                   
                    <div class="col-md-12 mt-5">
                    <p><b> Course Goals</b></p>

                    <!-- Goal Option Section -->
                    <div class="row add_item">
                        <div class="col-md-6">
                            <!-- Input field for entering course goals -->
                            <div class>                               
                                <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals ">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <!-- Button to add more input fields dynamically using JavaScript -->
                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                        </div>
                    </div> <!---end row-->

                    <!-- Hidden template for adding multiple goals dynamically with AJAX -->
                    <div style="visibility: hidden">
                        <div class="whole_extra_item_add p-0 m-0" id="whole_extra_item_add">
                            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                <div class="mt-3">
                                    <div class="row">
                                        <!-- Input field for entering additional goals -->
                                        <div class="form-group col-md-6">
                                            
                                            <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals ">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <!-- Buttons to add or remove additional input fields dynamically using JavaScript -->
                                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                                            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row mt-3">

                    <div class="col-md-4">
                        <div class="form-check">
                            <input name="bestseller" class="form-check-input" type="checkbox" id="bestseller">
                            <label class="form-check-label" for="bestseller">Bestseller</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input name="featured" class="form-check-input" type="checkbox" id="featured">
                            <label class="form-check-label" for="featured">Featured</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input id="highestrated" name="highestrated" class="form-check-input" type="checkbox"  id="highestrated">
                            <label class="form-check-label" for="highestrated">Highest Rated</label>
                        </div>
                    </div>

                </div>

                <div class="form-group row col-md-12 mt-5">
                    <label for="video" class="form-label"><b>Course Intro Video</b></label>
                    <div class="col-md-12 mt-3 d-flex justify-content-center">
                        <div style="max-width: 100%; overflow: hidden;">
                            <video width="100%" height="auto" controls id="showVideo">
                                <source src="" type="video/mp4">
                            </video>

                        </div>
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <input id="video" type="file" name="video" class="form-control" accept="video/mp4,video/webm" />
                    </div>  
                    
                </div>
            
                <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                </div>
            
             
        </form>
      
      </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#myForm').validate({
            rules: {
                course_name: {
                    required: true,
                },
                course_tittle: {
                    required: true,
                },

            },
            messages: {
                course_name: {
                    required: 'Please Enter Course Name',
                },
                course_tittle: {
                    required: 'Please Enter Course Tittle',
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

<script type="text/javascript">
    $(document).ready(function(){
        // Event listener for changes in the main category dropdown
        $('select[name="main_category_id"]').on('change', function(){
            // Extracting the selected value from the dropdown element that triggered the event
            var category_id = $(this).val();
            
            // Check if a category is selected
            if (category_id) {
                $.ajax({
                    // Make an AJAX request to get subcategories based on the selected main category
                    url: "{{ url('/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        // Clear existing subcategory options
                        $('select[name="subcategory_id"]').html('');
                        
                        // Populate the subcategory dropdown with the received data
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },
                });
            } else {
                // Alert if no category is selected (this can be customized based on your requirements)
                alert('danger');
            }
        });
    });
</script>


<!-- JavaScript code for handling dynamic addition and removal of input fields -->
<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        // Event handler for adding more input fields
        $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        // Event handler for removing input fields
        $(document).on("click",".removeeventmore",function(event){
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1;
    	if (counter < 0) {
        counter = 0; // Ensure counter doesn't go below 0
    	}
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // Attach a change event handler to the input with id 'video'
        $('#video').change(function(e){
            // Create a new FileReader object
            var reader = new FileReader();
        
            // Define a callback function to execute when the file has been read
            reader.onload = function(e){
                // Set the 'src' attribute of the video with id 'showVideo'
                $('#showVideo').attr('src', e.target.result);
            }
        
            // Read the contents of the selected file as a data URL
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // Attach a change event handler to the input with id 'image'
        $('#course_image').change(function(e){
            // Create a new FileReader object
            var reader = new FileReader();
        
            // Define a callback function to execute when the file has been read
            reader.onload = function(e){
                // Set the 'src' attribute of the image with id 'showCategoryImage'
                $('#showCourseImage').attr('src', e.target.result);
            }
        
            // Read the contents of the selected file as a data URL
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

<!--========== End of add multiple class with ajax ==============-->

@endsection