@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Report </li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">

            <div class="row">
                <div class="col-md-4">

                    <form id="myForm" action="{{ route('search.by.date') }}" method="post" class="row g-3" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Select Date</label>
                            <input type="date" name="date" class="form-control" id="input1"  >
                        </div> 

                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                  <button type="submit" class="btn btn-primary px-4">Get Report By Date</button>

                            </div>
                        </div>
                    </form>


                </div>

                <div class="col-md-4">

                    <form id="myForm" action="{{ route('search.by.month') }}" method="post" class="row g-3" enctype="multipart/form-data">
        @csrf

        @php
        $currentYear = date('Y');
        @endphp
        <div class="form-group col-md-12">
            <label for="input1" class="form-label">Select Month</label>
            <select name="month" class="form-select mb-3" aria-label="Default select example">
                <option disabled selected="">Open this select menu</option>
                <option value="Janurary">Janurary/{{$currentYear}}</option>
                <option value="February">February/{{$currentYear}}</option>
                <option value="March">March/{{$currentYear}}</option>
                <option value="April">April/{{$currentYear}}</option>
                <option value="May">May/{{$currentYear}}</option>
                <option value="Jun">Jun/{{$currentYear}}</option>
                <option value="July">July/{{$currentYear}}</option>
                <option value="August">August/{{$currentYear}}</option>
                <option value="September">September/{{$currentYear}}</option>
                <option value="October">October/{{$currentYear}}</option>
                <option value="November">November/{{$currentYear}}</option>
                <option value="December">December/{{$currentYear}}</option>
            </select>
        </div> 



        <div class="col-md-12">
            <div class="d-md-flex d-grid align-items-center gap-3">
    <button type="submit" class="btn btn-primary px-4">Get Report By Month</button>

            </div>
        </div>
    </form>

                </div>

                <div class="col-md-4">

                    <form id="myForm" action="{{ route('search.by.year') }}" method="post" class="row g-3" enctype="multipart/form-data">
        @csrf

        <div class="form-group col-md-12">
            <label for="input1" class="form-label">Select Year</label>
            <select name="year" class="form-select mb-3" aria-label="Default select example">
        <option disabled selected="">Open this select menu</option>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
            </select>
        </div> 

        <div class="col-md-12">
            <div class="d-md-flex d-grid align-items-center gap-3">
    <button type="submit" class="btn btn-primary px-4">Get Report By Year</button>

            </div>
        </div>
    </form>

                </div>

            </div> 
            {{-- // end row  --}}
        </div>
    </div>
</div>
@endsection