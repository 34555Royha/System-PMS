@extends('admin.main')

{{-- Inheritance Search --}}
@section('search')
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/categorys/searchcetegory" method="GET">
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
<h1 class="mt-4">Category</h1>
<div class="card mb-4">
<div class="card-body">
            <div class="row">
                @foreach ($categories as $category)
               <div class="col-sm-3 mt-2">
                <div class="card" style="width: auto;">
                    <img class="card-img-top" src="/img/categorys/{{ $category->image }}" alt="Card image cap" height="300">
                    <div class="card-body">
                      <h5 class="card-title">{{$category->name}}</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="/categorys/category/{{ $category->id }}" class="btn btn-primary">Show by category</a>
                    </div>
                  </div>
               </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>
</main>
@endsection