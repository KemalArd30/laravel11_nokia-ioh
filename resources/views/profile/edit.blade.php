@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">

<div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
    <h2>Profile Settings</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Update Name -->
    <div class="card mb-4">
        <div class="card-header">Update Name</div>
        <div class="card-body">
            <form action="{{ route('profile.updateName') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" id="role" name="role" class="form-control" value="{{ $role }}" disabled readonly>
                </div>
                <div class="mb-3">
                    <label for="regional" class="form-label">Regional</label>
                    <input type="text" id="regional" name="regional" class="form-control" value="{{ $regional }}" disabled readonly>
                </div>
                <button type="submit" class="btn btn-primary">Update Name</button>
            </form>
        </div>
    </div>

    <!-- Update Password -->
    <div class="card">
        <div class="card-header">Update Password</div>
        <div class="card-body">
            <form action="{{ route('profile.updatePassword') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                </div>
                <div class="col-sm-10">
                <a href="{{ route('summary') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
                <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
