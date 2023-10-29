@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('snacks.index') }}" class="btn btn-primary">Back to Snacks</a>
        </div>
        <h2>Create a Snack</h2>
        <form method="POST" action="{{ route('snacks.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredients:</label>
                <textarea class="form-control" id="ingredients" name="ingredients" required></textarea>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="Healthy">Healthy</option>
                    <option value="Meaty">Meaty</option>
                    <option value="Crispy">Crispy</option>
                    <option value="Cheesy">Cheesy</option>
                    <option value="Bars">Bars</option>
                </select>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Create Snack</button>
        </form>
    </div>
@endsection
