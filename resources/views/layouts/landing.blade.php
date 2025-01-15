@extends('layouts.layout')
@section('content')
@section('title', 'TipidApp')

    <div class="money-bg my-auto" style="background-image: url({{ asset('images/money-bg.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="landing-title text-shadow">How will you spend your money life?</h1>
                    <p class="landing-text text-shadow">Create a friendly, flexible plan and spend it well with Us.</p>
                </div>
                <div class="col">
                    @yield('authentication')
                </div>
            </div>
        </div>
    </div>
    <div class="container p-10"></div>
@endsection
