@extends('admin.main')

{{-- Inheritance container --}}
@section('content')
<main><div class="container-fluid">
<h1 class="mt-4">Edit Category: {{$categories->name}}</h1>
<div>
    <div class="card mb-4">
    <!-- It Show the form/input error -->
            @include('common.errors')
        <div class="card-body">
        <form action="{{route('category.update', $categories->id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{@csrf_token()}}">
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-sm-2">
                    <label for="">Name</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" id="name" value="{{$categories->name}}">
                </div>
                <div class="col-sm-2">
                    <label for="">Image</label>
                </div>
                <div class="col-sm-4">
                    <input type="file" class="form-control" name="image" id="image">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-8"></div>
                <div class="col-sm-2">
                    <a href="/category" class="btn btn-outline-warning w-100">Cancel</a>
                </div>
                <div class="col-sm-2">
                    <input type="submit" value="Update" class="btn btn-outline-success w-100">
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</main>
@endsection 