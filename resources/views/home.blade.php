@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
            <br/>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hello Kroketbal!</div>
                    <div class="card-body">
                        <h1>Welcome!</h1>
                        <p>
                            Welcome to KROKETBAL FACTORY the place for all your snack recipe needs
                            Do you love snacks? Fat? Healthy? Cheesy? Crispy? Then check out our Snacks
                            page to find user submitted recipes and snack ideas. Create your own account
                            to view the recipes and interact with 4 recipes to start sharing your snack ideas!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
