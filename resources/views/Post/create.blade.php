@extends('admin.main')



@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Create Product</h1>
        <div class="card mb-4">
            <div class="card-body">
            @if(Session::has('post_create'))
            <div class="alert alert-success"><em>{!! session('post_create') !!}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times</span></button>    
            </div>
            @endif
            <!-- It Show the form/input error -->
            @include('common.errors')
            

            <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{@csrf_token()}}">
                <div class="row">
                    <div class="col-2">
                        <label for="">Category</label>
                    </div>
                    <div class="col-4">
                        <select name="category_id" id="category_id" class="form-control">
                            <option hidden>Select</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1">
                        <label for="">Name</label>
                    </div>
                    <div class="col-5">
                        <input type="text" placeholder="Name" id="name" name="name" value="{{old('title')}}" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-2">
                        <label for="">Quantity</label>
                    </div>
                    <div class="col-4">
                        <input type="number" placeholder="Quantity" id="qty" name="qty" class="form-control">
                    </div>
                    <div class="col-1">
                        <label for="">Image</label>
                    </div>
                    <div class="col-5">
                        <input type="file" placeholder="image" id="image" name="image" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-2">
                        <label for="">Unit Price</label>
                    </div>
                    <div class="col-4">
                        <input type="number" placeholder="Price" id="price" name="price" class="form-control">
                    </div>
                    <div class="col-1">
                        <label for="">Discount</label>
                    </div>
                    <div class="col-5">
                        <input type="number" placeholder="Discount" id="discounts" name="discounts" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-2">
                        <label for="">Short Description</label>
                    </div>
                    <div class="col-10">
                        <input type="text" placeholder="Short Descripton" id="short_desc" name="short_desc" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-2">
                        <label for="">Long Description</label>
                    </div>
                    <div class="col-10">
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-8"></div>
                    <div class="col-2">
                        <a href="/post" class="btn btn-outline-warning w-100">Cancel</a>
                    </div>
                    <div class="col-2">
                        <input type="submit" value="Create" class="btn btn-outline-success w-100">
                    </div>
                </div>
            </form>

            </div>
        </div>
        <div style="height: 100vh"></div>
    </div>
</main>
@endsection