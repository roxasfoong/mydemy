@extends('instructor.instructor_dashboard')
@section('instructor')

<script src="{{asset('socketio/client-dist/socket.io.js')}}"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Live Chat</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card" style="min-width: 525px;" overflow-auto>
        <div class="card-body" >
            <h4>Live Chat </h4>
            <div id="app" data-user="{{ $currentUser->name }}">
                <node-chat></node-chat> 
               </div>
        </div>
    </div>
</div>
<script src="{{asset('socketio/client-dist/socket.io.js')}}"></script>

                        

@endsection