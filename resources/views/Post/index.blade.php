@extends('admin.main')

{{-- Inheritance Search --}}
{{-- @section('search')
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/frontend/searchpost" method="GET">
    <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." id="keyword" name="keyword" value="{{old('keyword')}}" aria-label="Search" aria-describedby="basic-addon2" />
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form> 
@endsection --}}

@section('content')
<main>
    <div class="container-fluid">
        <form action="/posts/search" method="GET" enctype="multipart/form-data">
           
            <input type="hidden" name="_token" value="{{@csrf_token()}}">
            <div class="row mt-3 mb-3">
                <div class="col-sm-1">
                    <a href="/post/create" class="btn btn-success">Create</a>
                </div>
                <div class="col-sm-1">
                    <label for="">Category Name</label>
                </div>
                <div class="col-sm-2">
                    <select name="category_id" id="category_id"  class="form-control">
                        <option value="">All</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
             </div>
                <div class="col-sm-1">
                    <label for="">Product Name</label>
                </div>
                <div class="col-sm-2">
                   <input type="text" placeholder="Product Name" name="name" id="name" class="form-control">    
                </div>
                <div class="col-sm-1">
                    <input type="submit" value="Search" class="btn btn-outline-success w-100">
                </div>
                <div class="col-sm-1">
                      <!-- Pagination -->
                      {!! $posts->appends(request()->input())->links(); !!}
                </div>
            </div>
        </form>
        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('post_update'))
                <div class="alert alert-success"><em>{{ session('post_update') }}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
                @if(Session::has('post_delete'))
                <div class="alert alert-danger"><em>{!! session('post_delete') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
            @if (count($posts) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Product
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover easy_table">
                            <thead class="thead-dark" style="text-align: center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Discount</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Option</th>
                            </thead>
                            <tbody style="text-align: center">
                                @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>
                                        <div>{{ $post->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $post->qty }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $post->price }}$</div>
                                    </td>
                                    <td>
                                        <div>{{ $post->discounts }}%</div>
                                    </td>
                                    <td>
                                        <div >{{ $post->category->name }}</div>                                        
                                    </td>
                                    <td style="text-align: center">
                                        <div>
                                            <img class="card-img-top" src="/img/posts/{{ $post->image }}" style="width: 80px;height: 60px;" alt="Card image cap">
                                        </div>                                      
                                    </td>
                                    <td>
                                        <div>{{ $post->short_desc }}</div>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="/post/{{$post->id}}" class="btn btn-warning btn-view"  categoryId="{{ $post->category_id }}">View</a>
                                        <a href="/post/{{$post->id}}/edit" class="btn btn-success">Update</a>
                                        <a href="/posts/delete/{{$post->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>   

                                @endforeach
                                <tr style="text-align: center" class="bg-dark text-light">
                                    <td>Total Product</td>
                                    <td>{{ $tproduct }}</td>
                                    <td>Total Quantity</td>
                                    <td>{{ $tqty }}</td>
                                    <td>Total Price</td>
                                    <td>{{ $ttotal }}$</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
            @endif
            </div>
        </div>
        <div class="card mb-4"><div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div></div>
    </div>
</main>
@endsection