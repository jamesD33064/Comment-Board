@extends('layouts.user-dashboard')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="card col">
            <div class="p-4">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <form action="/auth" method="post" id="loginForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">UserName</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card col">
            <div class="p-4">
                <div class="card-body">
                    <h5 class="card-title">Register</h5>
                    <form action="/api/user" method="post" id="registerForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Name</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection