@extends('template')
@section('content-left')
@foreach($postsPaginated as $post)
<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at }} by  Caio </p>

    <p>{{ $post->content }}</p>
    <hr>
</div><!-- /.blog-post -->
@endforeach
<nav>
    {!! $postsPaginated->render() !!}
</nav>
@stop
