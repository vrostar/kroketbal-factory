@extends('layouts.app')

@section('content')
    <div class="container">
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
                <p>(eg. Healthy, Meaty, Crispy, Bars etc.)</p>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Snack</button>
        </form>
    </div>
@endsection
