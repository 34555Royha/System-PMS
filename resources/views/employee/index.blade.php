@extends('admin.main')

{{-- Inheritance Search --}}
@section('search')
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/employees/search" method="GET">
    <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." id="keyword" name="keyword" value="{{old('keyword')}}" aria-label="Search" aria-describedby="basic-addon2" />
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
@endsection

@section('content')
<main>
    <div class="container-fluid">
        {{-- <h1 class="mt-4">Employee</h1> --}}
        <div class="row mt-2">
            <div class="col-sm-1">
            <a href="/employee/create" class="btn btn-success">Create</a>
            </div>
            <div class="col-sm-1">
                <!-- Pagination -->
                {!! $employees->appends(request()->input())->links(); !!}
        </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('employee_update'))
                <div class="alert alert-success"><em>{{ session('employee_update') }}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
                @if(Session::has('employee_delete'))
                <div class="alert alert-danger"><em>{!! session('employee_delete') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
            @if (count($employees) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Employees
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover easy_table">
                            <thead class="thead-dark" style="text-align: center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Date Of Birth</th>
                                <th>Image</th>
                                <th>Phone</th>
                                <th>Option</th>
                            </thead>
                            <tbody style="text-align: center">
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>
                                        <div>{{ $employee->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $employee->sex }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $employee->address }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $employee->DOB }}</div>
                                    </td>
                                   
                                    <td style="text-align: center">
                                        <div>
                                            <img class="card-img-top" src="/img/employees/{{ $employee->image }}" style="width: 80px;height: 60px;" alt="Card image cap">
                                        </div>                                      
                                    </td>
                                    <td>
                                        <div>{{ $employee->phone }}</div>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="/employee/{{$employee->id}}" class="btn btn-warning">View</a>
                                        <a href="/employee/{{$employee->id}}/edit" class="btn btn-success">Update</a>
                                        <a href="/employees/delete/{{$employee->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>   

                                @endforeach
                                <tr style="text-align: center" class="bg-dark text-light">
                                    <td>Total Employee</td>
                                    <td>{{ $count }}</td>
                                </tr>

                            </tbody>
                        </table> 
                    </div>
                </div>
            @endif
            </div>
        </div>
        {{-- <div style="height: 100vh"></div> --}}
        <div class="card mb-4"><div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div></div>
    </div>
</main>
@endsection