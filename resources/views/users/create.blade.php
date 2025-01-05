@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
    <h2>Add New User</h2>

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

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select" required>
                <option value="">Choose Role...</option>
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="regional" class="form-label">Region</label>
            <select id="regional" name="regional" class="form-select" required>
                <option value="">Choose Region...</option>
                <option value="HEAD OFFICE">HEAD OFFICE</option>
                <option value="LAMPUNG">LAMPUNG</option>
                <option value="PALEMBANG">PALEMBANG</option>
                <option value="PEKANBARU">PEKANBARU</option>
                <option value="KALSEL">KALSEL</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
@endsection
