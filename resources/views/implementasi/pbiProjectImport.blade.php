@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">

<div class="my-0 p-5 bg-body rounded shadow-sm mt-3">

    <div class="mb-4 mt-0">
        <h3>Import Data PBI Project</h3>
    </div>

    {{-- Display Flash Messages for Errors --}}
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Display Flash Message for Success --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Form untuk upload file -->
    <form action="{{ route('implementasi.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" />
        <button type="submit" class="btn btn-success" name="submit"> IMPORT </button>
    </form>

@endsection