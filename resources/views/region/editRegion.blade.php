@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">

<form action="{{ route('region.update', $region->coa) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="my-0 p-5 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="coa" class="col-sm-2 col-form-label">COA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="coa" id="coa" value="{{ old('coa', $region->coa) }}">
                @error('coa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="project" class="col-sm-2 col-form-label">Project</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="project" id="project" value="{{ old('project', $region->project) }}">
                @error('project')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-5 row">
            <label for="region" class="col-sm-2 col-form-label">Region</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="region" id="region" value="{{ old('region', $region->regional) }}">
                @error('region')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('region.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection
