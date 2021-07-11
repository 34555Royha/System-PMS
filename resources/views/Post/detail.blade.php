@extends('admin.main')

{{-- Inheritance Search --}}
@section('search')

<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/posts/searchpost" method="GET">
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
        <h1 class="mt-4">Product</h1>
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
                          <div class="container d-flex justify-content-center mb-50">
                            
                            <div class="row">
                                @foreach ($posts as $post)
                                <div class="col-md-6">
                                   
                                    <div class="mt-2"></div>
                                    <div class="card card-body" style="width: 100%">
                                        <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                            <div class="mr-2 mb-3 mb-lg-0"> <img src="/img/posts/{{ $post->image }}" width="150" height="150" alt=""> </div>
                                            <div class="media-body">
                                                <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">{{ $post->name }}</a> </h6>
                                                <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                                    <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">{{ $post->short_desc }}</a></li>
                                                </ul>
                                                <p class="mb-3">{{ $post->description }}</p>
                                                <ul class="list-inline list-inline-dotted mb-0">
                                                    <li class="list-inline-item">All items from <a href="#" data-abc="true">Mobile point</a></li>
                                                    <li class="list-inline-item">Add to <a href="#" data-abc="true">wishlist</a></li>
                                                </ul>
                                            </div>
                                            <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                                <h3 class="mb-0 font-weight-semibold">${{ $post->price }}</h3>
                                                <div> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                                <div class="text-muted">1985 reviews</div> 
                                               <div class="row">
                                                   <div class="col-12">
                                                    <button type="button" class="btn btn-warning mt-4 text-white w-100"><i class="icon-cart-add mr-2"></i> Add to cart</button>
                                                   </div>
                                               </div>
                                               <div class="row">
                                                <div class="col-12">
                                                 <a href="{!! url('show/' . $post->id ) !!}" class="btn btn-success mt-4 text-white w-100"><i class="icon-cart-add mr-2"></i> Detail</a>
                                                </div>
                                            </div>
                                            </div>
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