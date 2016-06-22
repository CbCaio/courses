<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>Blog Template for Bootstrap</title>

    {!! Html::style('assets/css/admin.css') !!}

            <!-- Custom styles for this template -->
    {!! Html::style('assets/css/blog.css') !!}

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item active" href="{{ route('blog.index') }}">Home</a>
            <a class="blog-nav-item" href="{{ route('blog.about') }}">Sobre</a>
        </nav>
    </div>
</div>

<div class="container">

    <div class="blog-header">
        <h1 class="blog-title">Code Education - Blog</h1>
        <p class="lead blog-description">Um exemplo de blog utilizando Bootstrap + Laravel.</p>
    </div>

    <div class="row">
        @section('content')
            <div class="col-sm-8 blog-main">
                @yield('content-left')
            </div><!-- /.blog-main -->

            <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                @section('content-right')
                    <div class="sidebar-module sidebar-module-inset">
                        <a href="{{ route('blog.about') }}">
                            <h4>Sobre</h4>
                            <p>
                                Apenas um esboço de blog. Laravel + Bootstrap
                            </p>
                            <p>
                                Extras: gulp, bower
                            </p>
                        </a>
                    </div>
                    <div class="sidebar-module">
                        <h4>Ultimas Postagens</h4>
                        <ol class="list-unstyled">
                            @foreach($posts as $post)
                            <li><a href="{{ route('blog.posts.view', [$post->id]) }}">{{ $post->title }}</a></li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="sidebar-module">
                    <h4>Midias Sociais</h4>
                    <ol class="list-unstyled">
                        <li></i><a href="www.github.com"><i class="fa fa-github fa-2x"></i> GitHub</a></li>
                        <li><a href="www.twitter.com"><i class="fa fa-twitter fa-2x"></i> Twitter</a></li>
                        <li><a href="www.facebook.com"><i class="fa fa-facebook fa-2x"></i> Facebook</a></li>
                    </ol>
                </div>
                @show
            </div><!-- /.blog-sidebar -->
        @show
    </div><!-- /.row -->

</div><!-- /.container -->

<footer class="blog-footer">
    <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{!! Html::script('assets/js/admin') !!}
</body>
</html>
