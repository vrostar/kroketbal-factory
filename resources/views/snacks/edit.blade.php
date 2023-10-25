@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Snack</h2>

        <form method="POST" action="{{ route('snacks.update', $snack->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Snack Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $snack->name }}">
            </div>

            <div class="form-group">
                <label for="ingredients">Ingredients:</label>
                <textarea name="ingredients" id="ingredients" class="form-control">{{ $snack->ingredients }}</textarea>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{ $snack->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <p>(eg. Healthy, Meaty, Crispy, Bars etc.)</p>
                <input type="text" name="type" id="type" class="form-control" value="{{ $snack->type }}">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
