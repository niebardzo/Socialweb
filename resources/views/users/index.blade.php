@extends('layouts.master')

@section('title')
    All Users
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-8">
            <h1>Users</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $users as $user)
                    @if($user->email !="admin@admin.com")
                <tr>
                    <th>{{ $user->first_name }}</th>
                    <td>{{ $user->email }}</td>
                    <td><a href="{{ route('user.delete', ['user_id'=> $user->id]) }}" class="glyphicon glyphicon-trash"></a></td>
                </tr>
                @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection