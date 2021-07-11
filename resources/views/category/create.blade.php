@extends('admin.main')

{{-- Inheritan content --}}
@section('content')
<main>
    <div class="container-fluid">
    <h1 class="mt-4">Create Category</h1>
        <div class="card mb-4">
            @if(Session::has('category_create'))
            <div class="alert alert-success"><em>{!! session('category_create') !!}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ariahidden="true">&times</span></button> 
            </div>
            @endif
            <!-- It Show the form/input error -->
            @include('common.errors')
            <div class="card-body">
                <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{@csrf_token()}}">
                    <div class="row">
                        <div class="col-2">
                            <label for="">Name</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="col-2">
                            <label for="">Image</label>
                        </div>
                        <div class="col-4">
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-8"></div>
                        <div class="col-2">
                            <a href="/category" class="btn btn-outline-warning w-100">Cancel</a>
                        </div>
                        <div class="col-2">
                            <input type="submit" value="Create" class="btn btn-outline-success w-100">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
