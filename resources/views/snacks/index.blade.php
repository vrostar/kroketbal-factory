@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>List of <a href="{{ url('/snacks') }}">Snacks</a></h2>

        <form action="{{ route('snacks.index') }}" method="GET">
            @csrf
            <div class="input-group mb-3">
                <input class="form-control form-control-sm" type="search" name="search" placeholder="Search..."
                       aria-label="Search" value="{{ $search }}">
                <div class="input-group-append">
                    <label for="type">
                        <select name="type" class="form-control form-control-md input-group-append">
                            <option value="">All Types</option>
                            <option value="Healthy">Healthy</option>
                            <option value="Meaty">Meaty</option>
                            <option value="Crispy">Crispy</option>
                            <option value="Cheesy">Cheesy</option>
                        </select>
                    </label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
            @auth
                <a href="{{ route('snacks.create') }}" class="btn btn-success btn-sm" title="Create Snack">Create
                    Snack</a>
            @endauth
        </form>

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
                        <a href="{{ route('snacks.show', $snack->id) }}" class="btn btn-primary">Show Recipe</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
