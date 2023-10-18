@extends('layouts.app')
@section('content')
    <style>
        /* Define the switch and its appearance */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        /* Checked state */
        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="mb-4 col-6">
                {{--Show message if user is successfully made admin.--}}
                @if (session('alert'))
                    <div class="alert alert-success" role="alert">
                        {{ session('alert') }}
                    </div>
                @endif
                <h2>Admin - Users</h2>
                <p>List of registered users.</p>
                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Admin?</th>
                        <th>Verified</th>
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
                                    @if(!$user->isAdmin())
                                        {{--Make user admin button for non admin-users--}}
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
