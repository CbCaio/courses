@extends('template')
@section('content-left')
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $post->title }}</h2>
        <p class="blog-post-meta">{{ $post->created_at }} by  Caio </p>

        <p>{{ $post->content }}</p>
        <hr>
    </div><!-- /.blog-post -->
@stop
