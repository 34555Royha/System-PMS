@extends('admin.main')
@section('content')
<main>
    <div class="container-fluid">
    <h1 class="mt-4">Delete Category: {{$categories->name}}</h1>
    <div>
        <div class="card mb-4">
            @if(Session::has('category_delete'))
            <div class="alert alert-danger"><em>{!! session('category_delete') !!}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ariahidden="true">&times</span></button> 
            </div>
            @endif
        <!-- It Show the form/input error -->
                @include('common.errors')
            <div class="card-body">
            <form action="{{route('category.destroy', $categories->id)}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{@csrf_token()}}">
                <input type="hidden" name="_method" value="DELETE">
                <div class="row">
                    <div class="col-2">
                        <label for="">Name</label>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" name="name" id="name" value="{{$categories->name}}" disabled>
                    </div>
                    <div class="col-2">
                        <label for="">Image</label>
                    </div>
                    <div class="col-4">
                        <input type="file" class="form-control" name="image" id="image" disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-8"></div>
                    <div class="col-2">
                        <a href="/category" class="btn btn-outline-warning w-100">Cancel</a>
                    </div>
                    <div class="col-2">
                        <input type="submit" value="Delete" class="btn btn-outline-danger w-100">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</main>
@endsection 