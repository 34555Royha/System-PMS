@extends('admin.main')
@section('content')
<main>
	<div class="container-fluid">
		<h1 class="mt-4">Delete Product</h1>
		<div class="card mb-4">
            <div class="card-body">
		<div>
		<!-- It Show the form/input error -->
                @if(Session::has('product_delete'))
                <div class="alert alert-danger"><em>{!! session('product_delete') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times</span></button>    
                </div>
                @endif
                @include('common.errors')

                 <form action="{{route('post.destroy', $post->id)}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{@csrf_token()}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <div class="row">
                            <div class="col-2">
                                <label for="">Category</label>
                            </div>
                            <div class="col-4" categoryId="{{ $post->category_id }}" id="categories">
                                <select name="category_id" id="category_id" class="form-control" disabled>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <label for="">Name</label>
                            </div>
                            <div class="col-5">
                                <input type="text" placeholder="Name" id="name" name="name" value="{{ $post->name}}" disabled class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-2">
                                <label for="">Quantity</label>
                            </div>
                            <div class="col-4">
                                <input type="number" placeholder="Quantity" id="qty" name="qty" value="{{ $post->qty}}" disabled class="form-control">
                            </div>
                            <div class="col-1">
                                <label for="">Image</label>
                            </div>
                            <div class="col-5">
                                <input type="file" placeholder="image" id="image" name="image" value="{{ $post->image}}" disabled class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-2">
                                <label for="">Unit Price</label>
                            </div>
                            <div class="col-4">
                                <input type="number" placeholder="Price" id="price" name="price" value="{{ $post->price }}" class="form-control" disabled>
                            </div>
                            <div class="col-1">
                                <label for="">Discount</label>
                            </div>
                            <div class="col-5">
                                <input type="number" placeholder="Discount" id="discounts" name="discounts" value="{{ $post->discounts }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-2">
                                <label for="">Short Description</label>
                            </div>
                            <div class="col-10">
                                <input type="text" placeholder="Short Descripton" id="short_desc" value="{{ $post->short_desc}}" disabled name="short_desc" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-2">
                                <label for="">Long Description</label>
                            </div>
                            <div class="col-10">
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control" disabled>value="{{ $post->description}}"</textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-8"></div>
                            <div class="col-2">
                                <a href="/post" class="btn btn-outline-warning w-100">Cancel</a>
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

