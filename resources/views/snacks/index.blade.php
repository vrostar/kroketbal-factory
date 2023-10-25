@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>List of Snacks</h2>
        <form method="GET" action="{{ route('snacks.index') }}" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search"
                   value="{{ $search }}">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <table class="table">

            @auth
                <a href="{{ route('snacks.create') }}" class="btn btn-success">Create Snack</a>
            @endauth

            <thead>
            <tr>
                <th>Snack Name</th>
                <th>Type</th>
                <th>Uploaded By</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($snacks as $snack)
                <tr>
                    <td>{{ $snack->name }}</td>
                    <td>{{ $snack->type }}</td>
                    <td>{{ $snack->user->name }}</td>
                    <td>
                        <a href="{{ route('snacks.show', $snack->id) }}" class="btn btn-primary">View Details</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
