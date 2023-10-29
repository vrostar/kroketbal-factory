@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="mb-4 col-6">
                {{--Show message at top of page to indicate turning user into admin was success--}}
                @if (session('alert'))
                    <div class="alert alert-success" role="alert">
                        {{ session('alert') }}
                    </div>
                @endif
                <h2>Users</h2>
                <p>List of Users, give users admin status by pressing the button</p>
                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Admin?</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                @auth
                                    {{--Check if user is admin,
                                    if they are allow them to turn users into admin--}}
                                    @if(!$user->isAdmin())
                                        <form action="{{ route('users.give-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.remove-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Remove Admin</button>
                                        </form>
                                    @endif

                                @endauth
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
