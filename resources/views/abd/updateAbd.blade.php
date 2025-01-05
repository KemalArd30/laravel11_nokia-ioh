@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<form action="{{ route('abd.update', $dataAbdList->id_implementasi) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
        <div class="fs-2 mb-3 row">Update ABD</div>

        <div class="mb-2 row d-flex align-items-center">
            <label for="project_year" class="col-sm-2 col-form-label-sm">Project Year
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->project_year }}" aria-label="project_year" disabled readonly>
            </label>
            <label for="site_id" class="col-sm-2 col-form-label-sm">Site ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->site_id }}" aria-label="site_id" disabled readonly>
            </label>
            <label for="site_name" class="col-sm-2 col-form-label-sm">Site Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->site_name }}" aria-label="site_name" disabled readonly>
            </label>
            <label for="system_key" class="col-sm-2 col-form-label-sm">System Key
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->system_key }}" aria-label="system_key" disabled readonly>
            </label>
            <label for="smp_id" class="col-sm-2 col-form-label-sm">SMP-ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->smp_id }}" aria-label="smp_id" disabled readonly>
            </label>
            <label for="phase_name" class="col-sm-2 col-form-label-sm">Phase Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->phase_name }}" aria-label="phase_name" disabled readonly>
            </label>
        </div>
        <div class="mb-3 row d-flex align-items-center">
            <label for="regional" class="col-sm-2 col-form-label-sm">Region
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->regional }}" aria-label="regional" disabled readonly>
            </label>
            <label for="zone" class="col-sm-2 col-form-label-sm">Zone
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->zone }}" aria-label="zone" disabled readonly>
            </label>
            <label for="status_site" class="col-sm-2 col-form-label-sm">Status Site
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->status_site }}" aria-label="status_site" disabled readonly>
            </label>
            <label for="oa_date" class="col-sm-2 col-form-label-sm">On Air Date
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->oa_date }}" aria-label="oa_date" disabled readonly>
            </label>
            <label for="status_oa" class="col-sm-2 col-form-label-sm">Status OA
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->status_oa }}" aria-label="status_oa" disabled readonly>
            </label>
            <label for="status_take_data_atp_born" class="col-sm-2 col-form-label-sm">Status Take Data ATP Born
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->status_take_data_atp_born }}" aria-label="status_take_data_atp_born" disabled readonly>
            </label>
        </div>
        <div class="mb-5 row d-flex align-items-center">
            <label for="atp_internal_review_date" class="col-sm-2 col-form-label-sm">ATP Internal Review Date
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->atp_internal_review_date }}" aria-label="atp_internal_review_date" disabled readonly>
            </label>
        </div>

        <div class="mb-3 row">
            <label for="abdw_file_naming" class="col-sm-2 col-form-label-sm">ABDW File Naming</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->abdw_file_naming }}" aria-label="abdw_file_naming" disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="upload_date_abdw_ppm" class="col-sm-2 col-form-label-sm">Upload Date ABDW PPM</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->upload_date_abdw_ppm }}" aria-label="upload_date_abdw_ppm" disabled readonly>
            </div>
        </div>
        <div class="mb-5 row">
            <label for="url_abdw_ppm" class="col-sm-2 col-form-label-sm">URL ABDW PPM</label>
            <div class="col-sm-10">
                <input type="url" class="form-control form-control-sm" name="url_abdw_ppm" id="url_abdw_ppm" value="{{ old('url_abdw_ppm', $dataAbdList->url_abdw_ppm) }}">
                @error('url_abdw_ppm')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label for="abdn_file_naming" class="col-sm-2 col-form-label-sm">ABDN File Naming</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->abdn_file_naming }}" aria-label="abdn_file_naming" disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="upload_date_abdn_ppm" class="col-sm-2 col-form-label-sm">Upload Date ABDN PPM</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" value="{{ $dataAbdList->upload_date_abdn_ppm }}" aria-label="upload_date_abdn_ppm" disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="url_abdn_ppm" class="col-sm-2 col-form-label-sm">URL ABDN PPM</label>
            <div class="col-sm-10">
                <input type="url" class="form-control form-control-sm" name="url_abdn_ppm" id="url_abdn_ppm" value="{{ old('url_abdn_ppm', $dataAbdList->url_abdn_ppm) }}">
                @error('url_abdn_ppm')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mb-5 row">
            <label for="remark" class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="remark" id="remark">{{ old('remark', $dataAbdList->remark) }}</textarea>
                @error('remark')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-1 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('abd.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection