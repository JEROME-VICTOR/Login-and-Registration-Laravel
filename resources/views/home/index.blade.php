@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            @if (isset($user_data['wallet_balance']) && is_numeric($user_data['wallet_balance']))
                <h1>Wallet Amount : {{$user_data['wallet_balance']}}</h1>
            @else
                <h1>Wallet Amount : N/A</h1>
            @endif
            <form method="post" action="{{ route('home.edit', [$user_data['id']]) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="text" class="form-control" name="deposit_amount"  placeholder="Enter the amount to be deposited in the wallet" required="required" autofocus><br>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Deposit</button>
            </form>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection
