@extends('admin.main')

{{-- Inheritance Search --}}
@section('search')
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/frontend/searchcetegory" method="GET">
    <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." id="keyword" name="keyword" value="{{old('keyword')}}" aria-label="Search" aria-describedby="basic-addon2" />
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
@endsection

{{-- Inheritance container --}}
@section('content')
<main>
<div class="container-fluid">
    <div class="row mt-2">
            <div class="col-sm-1">
            <a href="/category/create" class="btn btn-success">Create</a>
            </div>
            <div class="col-sm-1">
                <!-- Pagination -->
                {!! $categories->appends(request()->input())->links(); !!}
        </div>
    </div>
<div class="card mb-4">
<div class="card-body">
    
    {{-- Message --}}
        @if(Session::has('category_update'))
        <div class="alert alert-success"><em>{{ session('category_update') }}</em>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
        </div>
        @endif

        @if(Session::has('category_delete'))
       <div class="alert alert-danger"><em>{{ session('category_delete') }}</em>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
        </div>
        @endif


        {{-- Table --}}
        @if (count($categories) > 0)
            <table class="table table-striped table-bordered table-hover easy_table">
                <thead class="thead-dark" style="text-align: center">
                    <th>ID</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Option</th>
                </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr style="text-align: center">
                    <td>{{ $category->id }}</td>
                    <td><div>{{ $category->name }}</div></td>
                    <td >
                        <div>
                            <img class="card-img-top" src="/img/categorys/{{ $category->image }}" style="width: 80px;height: 60px;" alt="Card image cap">
                        </div>
                    </td>
                    <td style="text-align: center">
                        <a href="/category/{{$category->id}}" class="btn btn-warning">View</a>
                        <a href="/category/{{$category->id}}/edit" class="btn btn-success">Update</a>
                        <a href="/category/delete/{{$category->id}}" class="btn btn-danger">Delete</a>
                    </td>
             </tr> 
            @endforeach
            <tr style="text-align: center" class="bg-dark text-light">
                <td colspan="2">Total Category</td>
                <td>{{ $count }}</td>
            </tr>
            </tbody>
            </table>
        @endif
        </div>
        </div>
    </div>
</main>
@endsection