@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<form action="{{ route('atf.update', $dataAtfList->id_implementasi) }}" method="POST">
    @csrf
    <div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
        <div class="fs-2 mb-3 row">Update ATF</div>

        <div class="mb-2 row d-flex align-items-center">
            <label for="project_year" class="col-sm-2 col-form-label-sm">Project Year
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->project_year }}" aria-label="project_year" disabled readonly>
            </label>
            <label for="site_id" class="col-sm-2 col-form-label-sm">Site ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->site_id }}" aria-label="site_id" disabled readonly>
            </label>
            <label for="site_name" class="col-sm-2 col-form-label-sm">Site Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->site_name }}" aria-label="site_name" disabled readonly>
            </label>
            <label for="system_key" class="col-sm-2 col-form-label-sm">System Key
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->system_key }}" aria-label="system_key" disabled readonly>
            </label>
            <label for="smp_id" class="col-sm-2 col-form-label-sm">SMP-ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->smp_id }}" aria-label="smp_id" disabled readonly>
            </label>
            <label for="phase_name" class="col-sm-2 col-form-label-sm">Phase Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->phase_name }}" aria-label="phase_name" disabled readonly>
            </label>
        </div>
        <div class="mb-5 row d-flex align-items-center">
            <label for="regional" class="col-sm-2 col-form-label-sm">Region
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->regional }}" aria-label="regional" disabled readonly>
            </label>
            <label for="zone" class="col-sm-2 col-form-label-sm">Zone
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->zone }}" aria-label="zone" disabled readonly>
            </label>
            <label for="status_site" class="col-sm-2 col-form-label-sm">Status Site
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->status_site }}" aria-label="status_site" disabled readonly>
            </label>
            <label for="is13_1_main_equipment_is_onsite" class="col-sm-2 col-form-label-sm">IS13.1
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->is13_1_main_equipment_is_onsite }}" aria-label="is13_1_main_equipment_is_onsite" disabled readonly>
            </label>
            <label for="oa_date" class="col-sm-2 col-form-label-sm">On Air Date
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->oa_date }}" aria-label="oa_date" disabled readonly>
            </label>
            <label for="status_oa" class="col-sm-2 col-form-label-sm">Status OA
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->status_oa }}" aria-label="status_oa" disabled readonly>
            </label>
        </div>

        <div class="mb-3 row">
            <label for="atf_file_naming" class="col-sm-2 col-form-label-sm">ATF File Naming</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->atf_file_naming }}" aria-label="atf_file_naming" disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="upload_date_atf_ppm" class="col-sm-2 col-form-label-sm">Upload Date ATF PPM</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtfList->upload_date_atf_ppm }}" aria-label="upload_date_atf_ppm" disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="url_atf_ppm" class="col-sm-2 col-form-label-sm">URL ATF PPM</label>
            <div class="col-sm-10">
                <input type="url" class="form-control form-control-sm" name="url_atf_ppm" id="url_atf_ppm" value="{{ old('url_atf_ppm', $dataAtfList->url_atf_ppm) }}">
                @error('url_atf_ppm')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-5 row">
            <label for="remark" class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="remark" id="remark">{{ old('remark', $dataAtfList->remark) }}</textarea>
                @error('remark')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-1 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('atf.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection