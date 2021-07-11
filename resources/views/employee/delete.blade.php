@extends('admin.main')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Delete Employee</h1>
        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('employee_delete'))
                <div class="alert alert-danger"><em>{!! session('employee_delete') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times</span></button>    
                </div>
                @endif
            <!-- It Show the form/input error -->
            @include('common.errors')
            

            <form action="{{route('employee.destroy', $employee->id)}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{@csrf_token()}}">
                <input type="hidden" name="_method" value="DELETE">
                <div class="row">
                    <div class="col-sm-2">
                        <label for="">Name</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Name" id="name" name="name" value="{{ $employee->name}}"  value="{{old('name')}}" class="form-control" disabled>
                   
                    </div>
                    <div class="col-sm-1">
                        <label for="">Sex</label>
                    </div>
                    <div class="col-sm-5" Sex="{{ $employee->sex }}" id="sex">
                        <select name="sex" id="sex" class="form-control" disabled>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                     </div>
                </div>
                <div class="row mt-sm-2">
                    <div class="col-sm-2">
                        <label for="">Address</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Address" id="address" name="address" value="{{ $employee->address}}"   value="{{old('address')}}" class="form-control" disabled>
                    </div>
                    <div class="col-sm-1">
                        <label for="">Image</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="file" placeholder="image" id="image" name="image" value="{{ $employee->image}}"   value="{{old('image')}}" class="form-control" disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-2">
                        <label for="">Date Of Birth</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="date" placeholder="DOB" id="DOB" name="DOB"  value="{{ $employee->DOB}}" value="{{old('DOB')}}" class="form-control" disabled>
                    </div>
                    <div class="col-sm-1">
                        <label for="">Phone</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="number" placeholder="Phone" id="phone" name="phone" value="{{ $employee->phone}}"   value="{{old('phone')}}" class="form-control" disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-2">
                        <a href="/employee" class="btn btn-outline-warning w-100">Cancel</a>
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" value="Delete" class="btn btn-outline-danger w-100">
                    </div>
                </div>
            </form>

            </div>
        </div>
        <div style="height: 100vh"></div>
    </div>
</main>
@endsection