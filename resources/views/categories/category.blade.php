@extends('layouts.master')

@section('title')
    {{ $category->name }}
        @endsection
@section('content')
    @include('includes.message-block')
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
                <header><h3>{{$category->name}}</h3></header>
                @foreach($posts as $post)
                    <article class="post" data-postid="{{ $post->id }}">
                        <p>{{ $post->body }}</p>
                        <div class="info">
                            <div style="color:green;">{{ $post->likes }} People like it.</div>
                            <div style="color:red;">{{ $post->dislikes }} People dislike it</div>
                            Posted by {{ $post->user->first_name }} on {{ $post->created_at }} in {{ $post->category->name }}
                        </div>
                        <div class="interaction">
                            <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like' }}</a>
                            <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike' }}</a>
                            @if(Auth::user()==$post->user)
                                <a href="#" class="edit">Edit</a>
                                <a href="{{ route('post.delete', ['post_id'=> $post->id]) }}">Delete</a>
                            @endif
                            @if(Auth::user()->email=="admin@admin.com")
                                <a href="{{ route('post.delete.admin', ['post_id'=> $post->id]) }}">Hard Delete</a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit post</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="post-body">Edit the Post</label>
                                <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script>
            var token = '{{ Session::token() }}';
            var urlEdit= '{{ route('edit') }}';
            var urlLike= '{{ route('like') }}';
        </script>
    </div>
    </div>
    @endsection