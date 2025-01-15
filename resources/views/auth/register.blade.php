@extends('layouts.landing')
@section('authentication')
@section('title', 'TipidApp Register')

    <div class="p-4 bg-success bg-gradient rounded">
        <h1 class="mb-3">Register Here!</h1>
        <form action="{{ route('register') }}" method="post">
            @csrf
            @method('post')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" aria-describedby="name">
                @error('name')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" aria-describedby="emailHelp">
                @error('email')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
                @error('password_confirmation')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <input type="submit" value='Register' class="btn btn-dark"></input>
            <a class="text-black p-2" href="/login">Login</a>
        </form>

    </div>
@endsection
