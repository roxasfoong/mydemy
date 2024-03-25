@extends('instructor.instructor_dashboard')
@section('instructor')


<div class="page-content">
 
    {{-- ----------Breadcrumb----------- --}}
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Course Section</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href={{route('show.instructor.course')}}><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Course Section</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- ----------Breadcrumb----------- --}}

    {{-- ---------------Course Name, Image, Short Description-------------- --}}
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <img src="{{asset($course->course_image)}}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                <div class="flex-grow-1 ms-3">
                    <h5 class="mt-0">{{$course->course_tittle}}</h5>
                    <p class="mb-0">{{$course->course_name}}</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Section</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Section</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form name="myForm" id="myForm" action="{{route('store.course.section')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body"> <input type="text" name="section_title" id="section_title" class="form-control" placeholder="1. How to become a kind person"></div>
                            <div class="modal-footer">

                                <input type="hidden" name="id" value="{{$course->id }}">;
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
        </div>
    </div>
    {{-- ---------------Course Name, Image, Short Description-------------- --}}
    
 
    
</div>
   {{-- -----------------Add Course Section & Course Section Studylist-------------------------- --}}
   
    <div class="card">
        <div class="card-body">
            @foreach($section as $key => $item)
         <div class="row">
       <div class="col-12">
           <div class="card mb-0">
               <div class="card-body pt-4 d-flex justify-content-between">
                   <h6 class="col-9">{{$item->section_tittle}}</h6>
                   <div>
                    <form action="{{ route('delete.section', ['id' => $item->id]) }}" method="POST">
                        @csrf
                       <button type="submit" class="btn btn-danger mt-1"> Delete Section</button>
                    </form>
                       <a class="btn btn-primary mt-1" onclick="addLectureDiv({{$course->id}},{{$item->id}},'lectureContainer{{$key}}')"> Add Lecture</a>
                   </div>
               </div>
               
           </div>
           <div class="card mt-0" id="lectureContainer{{$key}}">
            <div class="card-body">
                @foreach ($item->lectures as $lecture) 
                <div class="p-0 d-flex justify-content-between lectureDiv">
                    
                    <h6 class="col-9">{{ $loop->iteration }}. {{ $lecture->lecture_tittle }}</h6>
                    <div>
                        
                        <a href="{{ route('edit.lecture',['id' => $lecture->id]) }}" class="btn btn-sm btn-primary mt-1">Edit</a>
                        <a id="delete" href="{{ route('delete.lecture',['id' => $lecture->id]) }}" class="btn btn-sm btn-danger mt-1">Delete</a>
                        
                        
                    </div>
                    
                </div>
                @endforeach
            </div>
          </div>

         
       </div>
      
   </div>
   @endforeach
</div>
   <div>
</div>

{{-- -----------------Add Course Section & Course Section Studylist-------------------------- --}}

<script>
    function addLectureDiv(courseId, sectionId, containerId) {
        const lectureContainer = document.getElementById(containerId);
        const newLectureDiv = document.createElement('div');
       
        newLectureDiv.classList.add('lectureDiv','p-0','card-body','d-flex','justify-content-between');
        newLectureDiv.innerHTML = `
        <div class="container-fluid">
    <h6>Lecture Title </h6>
    <input type="text" class="form-control" placeholder="Enter Lecture Title">
    <textarea class="form-control mt-2" placeholder="Enter Lecture Content"  ></textarea>
    <h6 class="mt-3">Add Video Url</h6>
    <input type="text" name="url" class="form-control" placeholder="Add URL">
    <button class="btn btn-primary mt-3" onclick="saveLecture('${courseId}',${sectionId},'${containerId}')" >Save Lecture</button>
    <button class="btn btn-secondary mt-3" onclick="hideLectureContainer('${containerId}')">Cancel</button>
    </div> 
     `;
     lectureContainer.appendChild(newLectureDiv);
    }

    function hideLectureContainer(containerId) {
        const lectureContainer = document.getElementById(containerId);
        lectureContainer.style.display = 'none';
        location.reload();
    }

// Function to save lecture details using AJAX (fetch API)
function saveLecture(courseId, sectionId, containerId) {
    // Get the container element using its ID
    const lectureContainer = document.getElementById(containerId);

    // Extract values from input elements within the container
    const lectureTitle = lectureContainer.querySelector('input[type="text"]').value;
    const lectureContent = lectureContainer.querySelector('textarea').value;
    const lectureUrl = lectureContainer.querySelector('input[name="url"]').value;

    // Use the fetch API to send a POST request to the server
    fetch('/save-lecture', {
        method: 'POST', // Specify the HTTP method
        headers: {
            'Content-Type': 'application/json', // Specify content type as JSON
            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token for Laravel
        },
        // Convert the data to a JSON string and send it in the request body
        body: JSON.stringify({
            course_id: courseId,
            section_id: sectionId,
            lecture_title: lectureTitle,
            lecture_url: lectureUrl,
            content: lectureContent,
        }),
    })
    // Handle the response as JSON
    .then(response => response.json())
    .then(data => {
        // Log the response data to the console (for debugging purposes)
        console.log(data);

           
               // Start Message 
               const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success', 
                  showConfirmButton: false,
                  timer: 6000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    title: data.success, 
                    })
            }else{
               
           Toast.fire({
                    type: 'error',
                    title: data.error, 
                    })
                }
            lectureContainer.style.display = 'none';
            location.reload();
              // End Message  
    })
    // Handle any errors that occur during the fetch operation
    .catch(error => {
        // Log the error to the console
        console.error(error);
    });
}
</script>

@endsection