@extends('layouts.master')

@section('title')
    {{ $category->name }}
        @endsection
@section('content')
<div id="wrapper">
    <div id="sidebar-wrapper" >
        <ul class="sidebar-nav">
            <li><a href="{{ route('dashboard') }}">Main Page</a></li>
            @foreach($categories as $categori)
                <li><a href="{{ route('showPosts', ['$category_id'=> $categori->id]) }}">{{ $categori->name }}</a></li>
            @endforeach

        </ul>

    </div>
    <div id="page-content-wrapper">
    <div class="col-lg-12">
        <h2><a href="#" class="glyphicon glyphicon-menu-hamburger" style="text-decoration: none;" id="menu-toggle"></a></h2>
    </div>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">

            <h3>Posts in {{ $category->name }}</h3>
            <br/>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->first_name }} on {{ $post->created_at }} in {{ $post->category->name }}
                    </div>
                    <div class="interaction">
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like' }}</a>
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike' }}</a>
                        @if(Auth::user()==$post->user)
                            <a href="#" class="edit">Edit</a>
                            <a href="{{ route('post.delete', ['post_id'=> $post->id]) }}">Delete</a>
                    </div>
                </article>
                @endif
            @endforeach
        </div>
    </section>
    </div>
    </div>
    @endsection