@extends('admin.main')

{{-- Inheritance Search --}}
@section('search')
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/employees/searchdetail" method="GET">
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
        <h1 class="mt-4">Employee</h1>
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
                        <div class="container">
                            <div class="row">
                                @foreach ($employees as $employee)
                                <div class="col-md-3">
                                    <hr>
                                    <div class="profile-card-4 text-center card"><img src="/img/employees/{{ $employee->image }}" class="img img-responsive" style="height: 220px">
                                        <div class="profile-content">
                                            {{-- <div class="profile-name">
                                                {{ $employee->name }}
                                                <p>{{ $employee->address }}</p>
                                            </div> --}}
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h5 style="text-align: left; font-weight: 10">Name:</h5>
                                                </div>
                                                <div class="col-sm-7">
                                                    <h5 style="text-align: left; font-weight: 10">{{ $employee->name }}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h5 style="text-align: left; font-weight: 10">Sex:</h5>
                                                </div>
                                                <div class="col-sm-7">
                                                    <h5 style="text-align: left; font-weight: 10">{{ $employee->sex }}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h5 style="text-align: left; font-weight: 10">Address:</h5>
                                                </div>
                                                <div class="col-sm-7">
                                                    <h5 style="text-align: left; font-weight: 10">{{ $employee->address }}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h5 style="text-align: left; font-weight: 10">DOB:</h5>
                                                </div>
                                                <div class="col-sm-7">
                                                    <h5 style="text-align: left; font-weight: 10">{{ $employee->DOB }}</h5>
                                                </div>
                                            </div>
                                            <ul class="social mb-0 list-inline mt-3">
                                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fab fa-facebook fa-2x"></i></a></li>
                                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fab fa-instagram fa-2x"></i></a></li>
                                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fab fa-telegram fa-2x"></i></a></li>
                                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa-solid fa-envelope fa-2x"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                            </div>
                        @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="card mb-4"><div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div></div>
</div>
</main>
@endsection