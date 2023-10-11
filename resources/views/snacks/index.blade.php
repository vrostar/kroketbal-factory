@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>List of Snacks</h2>
        <table class="table">

            @auth
                <a href="{{ route('snacks.create') }}" class="btn btn-success">Create Snack</a>
            @endauth

            <thead>
            <tr>
                <th>Snack Name</th>
                <th>Uploaded By</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($snacks as $snack)
                <tr>
                    <td>{{ $snack->name }}</td>
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
