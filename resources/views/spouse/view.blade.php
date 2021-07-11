@extends('admin.main')



@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">View Spouse</h1>
        <div class="card mb-4">
            <div class="card-body">
            @if(Session::has('spouse_create'))
            <div class="alert alert-success"><em>{!! session('spouse_create') !!}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times</span></button>    
            </div>
            @endif
            <!-- It Show the form/input error -->
            @include('common.errors')
            <form action="{{route('spouse.store')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{@csrf_token()}}">
                <div class="row">
                    <div class="col-sm-2">
                        <label for="">Name</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Name" id="name" name="name"  value="{{ $spouse->name}}"  value="{{old('name')}}" class="form-control" disabled>
                   
                    </div>
                    <div class="col-sm-1">
                        <label for="">Employee</label>
                    </div>
                    <div class="col-sm-5" employee_id="{{ $spouse->employee_id }}" id="employee_id">
                        <select name="employee_id" id="employee_id" class="form-control" disabled>
                            @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                        </select>
                     </div>
                </div>
                <div class="row mt-sm-2">
                    <div class="col-sm-2">
                        <label for="">Address</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Address" id="address" name="address" value="{{ $spouse->address}}"   value="{{old('address')}}" class="form-control" disabled>
                    </div>
                    <div class="col-sm-1">
                        <label for="">Sex</label>
                    </div>
                    <div class="col-sm-5" Sex="{{ $spouse->sex }}" id="sex">
                        <select name="sex" id="sex" class="form-control" disabled>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                     </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-2">
                        <label for="">Date Of Birth</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="date" placeholder="DOB" id="DOB" name="DOB" value="{{ $spouse->DOB}}"   value="{{old('DOB')}}" class="form-control" disabled>
                    </div>
                    <div class="col-sm-1">
                        <label for="">Phone</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="number" placeholder="Phone" id="phone" name="phone"  value="{{ $spouse->phone}}"   value="{{old('phone')}}" class="form-control" disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4">
                        <a href="/spouse" class="btn btn-outline-warning w-100">Cancel</a>
                    </div>
                </div>
            </form>

            </div>
        </div>
</main>
@endsection