@extends('admin.main')

{{-- Inheritance Search --}}
@section('search')
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/spouses/search" method="GET">
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
        <div class="row mt-2">
            <div class="col-sm-1">
            <a href="/spouse/create" class="btn btn-success">Create</a>
            </div>
            <div class="col-sm-1">
                <!-- Pagination -->
                {!! $spouses->appends(request()->input())->links(); !!}
        </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('spouse_update'))
                <div class="alert alert-success"><em>{{ session('spouse_update') }}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
                @if(Session::has('spouse_delete'))
                <div class="alert alert-danger"><em>{!! session('spouse_delete') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
            @if (count($spouses) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Spouses
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover easy_table">
                            <thead class="thead-dark" style="text-align: center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Employee Name</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Date Of Birth</th>
                                <th>Phone</th>
                                <th>Option</th>
                            </thead>
                            <tbody style="text-align: center">
                                @foreach ($spouses as $spouse)
                                <tr>
                                    <td>{{ $spouse->id }}</td>
                                    <td>
                                        <div>{{ $spouse->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $spouse->employee->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $spouse->sex }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $spouse->address }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $spouse->DOB }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $spouse->phone }}</div>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="/spouse/{{$spouse->id}}" class="btn btn-warning">View</a>
                                        <a href="/spouse/{{$spouse->id}}/edit" class="btn btn-success">Update</a>
                                        <a href="/spouses/delete/{{$spouse->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>   

                                @endforeach
                                <tr style="text-align: center" class="bg-dark text-light">
                                    <td>Total Spouse</td>
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