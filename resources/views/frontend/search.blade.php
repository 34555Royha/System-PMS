<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Home - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        {{Html::style('css/styles.css')}}
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">
                                Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-md-8">
                    <h1 class="my-4">
                       Post
                        <small>Secondary Text</small>
                    </h1>
                    <!-- Blog post-->
                    @foreach ($posts as $post)
                    <div class="card mb-4">
                        {!! Html::image("/img/posts/".$post->image, $post->title, array('width'=>'auto'))  !!}
                        <div class="card-body">
                            <h2 class="card-title">{!! $post->title !!}</h2>
                            <p class="card-text">{!! $post->short_desc !!}</p>
                            <a href="/show/{{$post->id}}" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on January 1, 2021 by {!! $post->author !!}
                            <a href="#!">Start Bootstrap</a>
                        </div>
                    </div>
                    @endforeach

                    <!-- Pagination-->
                    {{-- <ul class="pagination justify-content-center mb-4">
                        <li class="page-item"><a class="page-link" href="#!">← Older</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#!">Newer →</a></li>
                    </ul> --}}
                      <!-- Pagination -->
        {!! $posts->appends(request()->input())->links(); !!}
                </div>
                <!-- Side widgets-->
                <div class="col-md-4">
                    <!-- Search widget-->
                    <div class="card my-4">
                        <h5 class="card-header">Search</h5>
                        <div class="card-body">
                            <div class="input-group">
                                <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/frontend/search" method="GET">
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="Search for..." id="keyword" name="keyword" aria-label="Search" aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card my-4">
                        <h5 class="card-header">Categories</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled mb-0">
                                        @foreach($categories as  $category)
                                        <li><a href="/frontend/category/{{ $category->id }}">{{ $category->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card my-4">
                        <h5 class="card-header">Side Widget</h5>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
         <!-- <script src="js/scripts.js"></script> -->
         {{Html::script('js/scripts.js')}}
    </body>
</html>

