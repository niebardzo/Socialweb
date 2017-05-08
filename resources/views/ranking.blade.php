@extends('layouts.master')

@section('title')
    Ranking
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>The best posts</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>Post</th>
                    <th>Owner</th>
                    <th>Likes</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $posts as $post)
                    <tr>

                        <td><article class="post"  data-postid="{{ $post->id }}">
                                <p>{{ $post->body }}</p>
                            </article></td>
                        <td>{{$post->user->first_name }}</td>
                        <td>{{$post->likes}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection