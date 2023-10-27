@extends('layouts.app')

@section('content')
    @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-warning">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h2>List of
            <a href="{{ url('/snacks') }}">Snacks</a>
        </h2>
        <form action="{{ route('snacks.index') }}" method="GET">
            <div class="input-group">
                <input class="form-control form-control-sm" type="search" name="search" placeholder="Search..." aria-label="Search" value="{{ $search }}">
                    <select name="type" class="form-control form-control-sm">
                        <option value="">All Types</option>
                        <option value="Healthy">Healthy</option>
                        <option value="Meaty">Meaty</option>
                        <option value="Crispy">Crispy</option>
                        <option value="Cheesy">Cheesy</option>
                    </select>
                <button class="btn btn-outline-success my-2 my-sm-0 ml-2" type="submit">Search</button>
            </div>
        </form>

        <div>
            @auth
                    <a href="{{ route('snacks.create') }}" class="btn btn-success btn-sm" title="Create Snack">Create Snack</a>
            @endauth
        </div>

        <table class="table mt-3">
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
