@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('snacks.index') }}" class="btn btn-primary">Back to Snacks</a>
        </div>
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
                <select class="form-control" name="type">
                    <option value="Healthy"{{ $snack->type === 'Healthy' ? ' selected' : '' }}>Healthy</option>
                    <option value="Meaty"{{ $snack->type === 'Meaty' ? ' selected' : '' }}>Meaty</option>
                    <option value="Crispy"{{ $snack->type === 'Crispy' ? ' selected' : '' }}>Crispy</option>
                    <option value="Bars"{{ $snack->type === 'Bars' ? ' selected' : '' }}>Bars</option>
                </select>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
