@extends('admin.main')
@section('content')
        <!-- Page content-->
        <div class="container" style="margin:auto; width: 50%;">
            <div class="row">
                <!-- Post content-->
                <div class="col-lg-8">
                    <!-- Title-->
                    <h1 class="mt-4">{{$post->title}}</h1>
                    <!-- Author-->
                    <p class="lead">
                        by
                        <a href="#!">{{$post->author}}</a>
                    </p>
                    <hr />
                    <!-- Date and time-->
                    <p>Posted on {{$post->updated_at}}</p>
                    <hr />
                    <!-- Preview image-->
                    {!! Html::image("/img/posts/".$post->image, $post->title, array('width'=>'auto'))  !!}
                    <hr />
                     <!-- Post Content -->
                    <p class="lead">{{$post->short_desc}}</p>
                    <p>{{$post->description}}</p>

                    <hr>
               
            </div>
        </div>
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form>
                    <div class="form-group"><textarea class="form-control" rows="3"></textarea></div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
        <!-- Single comment-->
        <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="..." />
            <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>
        <!-- Comment with nested comments-->
        <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="..." />
            <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                <div class="media mt-4">
                    <img class="d-flex mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="..." />
                    <div class="media-body">
                        <h5 class="mt-0">Commenter Name</h5>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
                <div class="media mt-4">
                    <img class="d-flex mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="..." />
                    <div class="media-body">
                        <h5 class="mt-0">Commenter Name</h5>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        {{Html::style('js/scripts.js')}}
        @endsection