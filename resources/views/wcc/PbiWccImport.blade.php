@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">

<div class="my-0 p-5 bg-body rounded shadow-sm mt-3">

    <div class="mb-5 mt-0">
        <h2>Import Data PBI WCC</h2>
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
    <div class="mb-3">
    <h5>PBI WCC Full Payment</h5>
    </div>
    <div class="mb-5 row">
    <form action="{{ route('wcc.import-full-payment') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" />
        <button type="submit" class="btn btn-success" name="submit"> IMPORT </button>
    </form>
    </div>

    <div class="mb-3">
        <h5>PBI WCC Partial Payment</h5>
        </div>
        <div class="mb-1 row">
    <form action="{{ route('wcc.import-partial-payment') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" />
        <button type="submit" class="btn btn-success" name="submit"> IMPORT </button>
    </form>
        </div>

@endsection