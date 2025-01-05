@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="password" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="regional" class="col-sm-2 col-form-label">Region</label>
            <div class="col-sm-10">
                <select id="regional" name="regional" class="form-select" required>
                    <option value="">Choose Region...</option>
                    <option value="HEAD OFFICE" {{ old('regional', $user->regional) === 'HEAD OFFICE' ? 'selected' : '' }}>HEAD OFFICE</option>
                    <option value="LAMPUNG" {{ old('regional', $user->regional) === 'LAMPUNG' ? 'selected' : '' }}>LAMPUNG</option>
                    <option value="PALEMBANG" {{ old('regional', $user->regional) === 'PALEMBANG' ? 'selected' : '' }}>PALEMBANG</option>
                    <option value="PEKANBARU" {{ old('regional', $user->regional) === 'PEKANBARU' ? 'selected' : '' }}>PEKANBARU</option>
                    <option value="KALSEL" {{ old('regional', $user->regional) === 'KALSEL' ? 'selected' : '' }}>KALSEL</option>
                </select>
            </div>
        </div>
        <div class="mb-5 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select id="role" name="role" class="form-select" required>
                    <option value="">Choose Role...</option>
                    <option value="user" {{ old('role', $role) === 'user' ? 'selected' : '' }}>user</option>
                    <option value="admin" {{ old('role', $role) === 'admin' ? 'selected' : '' }}>admin</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection
