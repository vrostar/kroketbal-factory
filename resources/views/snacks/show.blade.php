@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Snack Details</h2>
        <h3>Snack Name: {{ $snack->name }}</h3>
        <p>Ingredients: {{ $snack->ingredients }}</p>
        <p>Description: {{ $snack->description }}</p>
        <p>Uploaded By: {{ $snack->user->name }}</p>

        <div class="mb-4">
            @auth
                @can('update-snack', $snack)
                    <a href="{{ route('snacks.edit', $snack->id) }}" class="btn btn-primary">Edit Snack</a>
                @endcan
            @endauth
        </div>

        <div>
            @auth
                @if(Gate::allows('admin') || Gate::allows('delete-snack', $snack))
                    <form method="POST" action="{{ route('snacks.destroy', $snack->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Snack</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
@endsection
