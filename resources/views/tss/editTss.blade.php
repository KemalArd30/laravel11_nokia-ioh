@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<form action="{{ route('tss.update', $dataTssList->id_tss) }}" method="POST">
    @csrf
    <div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
        <div class="fs-2 mb-3 row">Update TSS</div>

        <div class="mb-2 row d-flex align-items-center">
            <label for="project_year" class="col-sm-2 col-form-label-sm">Project Year
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->project_year }}" aria-label="project_year" disabled readonly>
            </label>
            <label for="site_id" class="col-sm-2 col-form-label-sm">Site ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->site_id }}" aria-label="site_id" disabled readonly>
            </label>
            <label for="site_name" class="col-sm-2 col-form-label-sm">Site Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->site_name }}" aria-label="site_name" disabled readonly>
            </label>
            <label for="system_key" class="col-sm-2 col-form-label-sm">System Key
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->system_key }}" aria-label="system_key" disabled readonly>
            </label>
            <label for="smp_id" class="col-sm-2 col-form-label-sm">SMP-ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->smp_id }}" aria-label="smp_id" disabled readonly>
            </label>
            <label for="moduleID" class="col-sm-2 col-form-label-sm">Module ID
                <input class="form-control form-control-sm" disabled type="text" placeholder="{{ $dataTssList->module_id }}">
            </label>
        </div>
        <div class="mb-2 row d-flex align-items-center">
            <label for="phase_name" class="col-sm-2 col-form-label-sm">Phase Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->phase_name }}" aria-label="phase_name" disabled readonly>
            </label>
            <label for="regional" class="col-sm-2 col-form-label-sm">Region
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->regional }}" aria-label="regional" disabled readonly>
            </label>
            <label for="zone" class="col-sm-2 col-form-label-sm">Zone
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->zone }}" aria-label="zone" disabled readonly>
            </label>
            <label for="status_site" class="col-sm-2 col-form-label-sm">Status Site
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->status_site }}" aria-label="status_site" disabled readonly>
            </label>
            <label for="scm_assigned_to_fst" class="col-sm-2 col-form-label-sm">SCM Assigned to FST
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->scm_assigned_to_fst }}" aria-label="scm_assigned_to_fst" disabled readonly>
            </label>
            <label for="fill_tss_checklist_complete" class="col-sm-2 col-form-label-sm">Fill TSS Checklist Complete
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->fill_tss_checklist_complete }}" aria-label="fill_tss_checklist_complete" disabled readonly>
            </label>
        </div>
        <div class="mb-5 row d-flex align-items-center">
            <label for="review_by_scm" class="col-sm-2 col-form-label-sm">Review by SCM
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->review_by_scm }}" aria-label="review_by_scm" disabled readonly>
            </label>
            <label for="review_by_pe" class="col-sm-2 col-form-label-sm">Review by PE
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->review_by_pe }}" aria-label="review_by_pe" disabled readonly>
            </label>
            <label for="tssr_done" class="col-sm-2 col-form-label-sm">TSS Approved Date
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->tssr_done }}" aria-label="tssr_done" disabled readonly>
            </label>
        </div>

        <div class="mb-3 row">
            <label for="tssr_file_naming" class="col-sm-2 col-form-label-sm">TSSR File Naming</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->tssr_file_naming }}" aria-label="tssr_file_naming" disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="uploadDateTssrPpm" class="col-sm-2 col-form-label-sm">Upload Date TSSR PPM</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" value="{{ $dataTssList->upload_date_tssr_ppm }}" aria-label="uploadDateTssrPpm" disabled readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="urlTssrPpm" class="col-sm-2 col-form-label-sm">URL TSSR PPM</label>
            <div class="col-sm-10">
                <input type="url" class="form-control form-control-sm" name="urlTssrPpm" id="urlTssrPpm" value="{{ old('url_tssr_ppm', $dataTssList->url_tssr_ppm) }}">
                @error('urlTssrPpm')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-5 row">
            <label for="remark" class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="remark" id="remark">{{ old('remark', $dataTssList->remark) }}</textarea>
                @error('remark')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-1 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('tss.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection