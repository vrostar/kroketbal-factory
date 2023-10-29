@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-warning">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
            </div>
        @endif
        <div class="mb-3">
            <a href="{{ route('snacks.index') }}" class="btn btn-primary">Back to Snacks</a>
        </div>
        <h2>Snack Details</h2>
        <h3>Snack Name: {{ $snack->name }}</h3>
        <p>Ingredients: {{ $snack->ingredients }}</p>
        <p>Description: {{ $snack->description }}</p>
        <p>Type: {{ $snack->type }}</p>
        <p>Uploaded By: {{ $snack->user->name }}</p>

        {{--            Check if user is allowed to edit the snack if so show edit button--}}
        <div class="mb-4">
            @auth
                @can('update-snack', $snack)
                    <a href="{{ route('snacks.edit', $snack->id) }}" class="btn btn-primary">Edit Snack</a>
                @endcan
            @endauth
        </div>

        {{--            Check if user is allowed to delete snack or is admin if so show button--}}
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
