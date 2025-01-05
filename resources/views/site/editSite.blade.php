@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">

<form action="{{ route('sitelist.update', $sitelist->id_sitelist) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="my-0 p-5 bg-body rounded shadow-sm mt-3">
        <div class="fs-2 mb-5 row">Edit Site</div>
        
        <div class="mb-3 row">
            <label for="projectYear" class="col-sm-2 col-form-label">Project Year</label>
            <div class="col-sm-10">
                <input type="number" class="date-own form-control" name="projectYear" id="projectYear" value="{{ old('project_year', $sitelist->project_year) }}">
                @error('projectYear')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="area" class="col-sm-2 col-form-label">Area</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="area" id="area" value="{{ old('area', $sitelist->area) }}">
                @error('area')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="zone" class="col-sm-2 col-form-label">Zone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="zone" id="zone" value="{{ old('zone', $sitelist->zone) }}">
                @error('zone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="systemKey" class="col-sm-2 col-form-label">System Key</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="systemKey" id="systemKey" value="{{ old('system_key', $sitelist->system_key) }}">
                @error('systemKey')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="smpId" class="col-sm-2 col-form-label">SMP-ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="smpId" id="smpId" value="{{ old('smp_id', $sitelist->smp_id) }}">
                @error('smpId')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="siteId" class="col-sm-2 col-form-label">Site ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="siteId" id="siteId" value="{{ old('site_id', $sitelist->site_id) }}">
                @error('siteId')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="siteName" class="col-sm-2 col-form-label">Site Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="siteName" id="siteName" value="{{ old('site_name', $sitelist->site_name) }}">
                @error('siteName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="statusSite-{{ $sitelist->id_sitelist }}" class="col-sm-2 col-form-label">Status Site</label>
            <div class="col-sm-10">
            <select class="form-select modal-form-control form-select" name="statusSite" aria-label="Default select example">
              <option value="">Choose Status</option>
              <option value="ACTIVE" {{ $sitelist->status_site == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
              <option value="INACTIVE" {{ $sitelist->status_site == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
          </select>
          @error('statusSite')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
          </div>
            <div class="mb-3 row">
                <label for="phaseName" class="col-sm-2 col-form-label">Phase Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="phaseName" id="phaseName" value="{{ old('phase_name', $sitelist->phase_name) }}">
                    @error('phaseName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        </div>
        <div class="mb-3 row">
            <label for="phaseGroup" class="col-sm-2 col-form-label">Phase Group</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="phaseGroup" id="phaseGroup" value="{{ old('phase_group', $sitelist->phase_group) }}">
                @error('phaseGroup')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
    </div>
    <div class="mb-3 row">
        <label for="sow" class="col-sm-2 col-form-label">SOW</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="sow" id="sow" value="{{ old('sow', $sitelist->sow) }}">
            @error('sow')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="sowDetail" class="col-sm-2 col-form-label">SOW Detail</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="sowDetail" id="sowDetail" value="{{ old('sow_detail', $sitelist->sow_detail) }}">
            @error('sowDetail')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-5 row">
        <label for="remark" class="col-sm-2 col-form-label">Remark</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" name="remark" id="remark">{{ old('remark', $sitelist->remark) }}</textarea>
            @error('remark')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
        <div class="mb-1 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('sitelist.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection
