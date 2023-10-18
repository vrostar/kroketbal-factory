@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('alert'))
                    <div class="alert alert-success" role="alert">
                        {{ session('alert') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h1>Edit Profile</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', ['user' => $user]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input id="name"
                                       name="name"
                                       type="text"
                                       value="{{ old('name', $user->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail:</label>
                                <input id="email"
                                       name="email"
                                       type="text"
                                       value="{{ old('email', $user->email) }}"
                                       class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input id="password"
                                       name="password"
                                       type="password"
                                       class="form-control @error('password') is-invalid @enderror">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                                <input id="password_confirmation"
                                       name="password_confirmation"
                                       type="password"
                                       class="form-control">
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
