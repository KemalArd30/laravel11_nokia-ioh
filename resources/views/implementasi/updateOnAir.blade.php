@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<form action="{{ route('implementasi.update', $dataImplementasiList->id_implementasi) }}" method="POST">
    @csrf
    <div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
        <div class="fs-2 mb-3 row">Update On Air</div>

        <div class="mb-2 row d-flex align-items-center">
            <label for="project_year" class="col-sm-2 col-form-label-sm">Project Year
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->project_year }}" aria-label="project_year" disabled readonly>
            </label>
            <label for="site_id" class="col-sm-2 col-form-label-sm">Site ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->site_id }}" aria-label="site_id" disabled readonly>
            </label>
            <label for="site_name" class="col-sm-2 col-form-label-sm">Site Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->site_name }}" aria-label="site_name" disabled readonly>
            </label>
            <label for="system_key" class="col-sm-2 col-form-label-sm">System Key
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->system_key }}" aria-label="system_key" disabled readonly>
            </label>
            <label for="smp_id" class="col-sm-2 col-form-label-sm">SMP-ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->smp_id }}" aria-label="smp_id" disabled readonly>
            </label>
            <label for="module_id" class="col-sm-2 col-form-label-sm">Module ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->module_id }}" aria-label="module_id" disabled readonly>
            </label>
        </div>
        <div class="mb-2 row d-flex align-items-center">
            <label for="phase_name" class="col-sm-2 col-form-label-sm">Phase Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->phase_name }}" aria-label="phase_name" disabled readonly>
            </label>
            <label for="regional" class="col-sm-2 col-form-label-sm">Region
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->regional }}" aria-label="regional" disabled readonly>
            </label>
            <label for="zone" class="col-sm-2 col-form-label-sm">Zone
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->zone }}" aria-label="zone" disabled readonly>
            </label>
            <label for="status_site" class="col-sm-2 col-form-label-sm">Status Site
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->status_site }}" aria-label="status_site" disabled readonly>
            </label>
            <label for="ms13_ready_for_implementation" class="col-sm-2 col-form-label-sm">MS13
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->ms13_ready_for_implementation }}" aria-label="ms13_ready_for_implementation" disabled readonly>
            </label>
            <label for="is13_1_main_equipment_is_onsite" class="col-sm-2 col-form-label-sm">IS13.1
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->is13_1_main_equipment_is_onsite }}" aria-label="is13_1_main_equipment_is_onsite" disabled readonly>
            </label>
        </div>
        <div class="mb-5 row d-flex align-items-center">
            <label for="ms15_implementation_starts" class="col-sm-2 col-form-label-sm">MS15
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->ms15_implementation_starts }}" aria-label="ms15_implementation_starts" disabled readonly>
            </label>
            <label for="is15_1_installation_complete" class="col-sm-2 col-form-label-sm">IS15.1
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->is15_1_installation_complete }}" aria-label="is15_1_installation_complete" disabled readonly>
            </label>
            <label for="is15_4_integration_complete" class="col-sm-2 col-form-label-sm">IS15.4
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->is15_4_integration_complete }}" aria-label="is15_4_integration_complete" disabled readonly>
            </label>
            <label for="ms16_implementation_ends" class="col-sm-2 col-form-label-sm">MS16
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->ms16_implementation_ends }}" aria-label="ms16_implementation_ends" disabled readonly>
            </label>
            <label for="ms17_site_acceptance" class="col-sm-2 col-form-label-sm">MS17
                <input class="form-control form-control-sm" type="text" value="{{ $dataImplementasiList->ms17_site_acceptance }}" aria-label="ms17_site_acceptance" disabled readonly>
            </label>
        </div>

        <div class="mb-3 row">
            <label for="oa_date" class="col-sm-2 col-form-label-sm">On Air Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control form-control-sm" name="oa_date" id="oa_date" value="{{ old('upload_date_tssr_ppm', $dataImplementasiList->oa_date) }}" required>
                @error('oa_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="status_oa" class="col-sm-2 col-form-label-sm">Status OA</label>
            <div class="col-sm-10">
                <select class="form-select form-select-sm" name="status_oa" id="status_oa">
                    <option value="">Choose Status...</option>
                    <option value="FOA" {{ old('status_oa', $dataImplementasiList->status_oa) == 'FOA' ? 'selected' : '' }}>FOA</option>
                    <option value="Partial OA" {{ old('status_oa', $dataImplementasiList->status_oa) == 'Partial OA' ? 'selected' : '' }}>Partial OA</option>
                </select>
                @error('status_oa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-5 row">
            <label for="remark" class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="remark" id="remark">{{ old('remark', $dataImplementasiList->remark) }}</textarea>
                @error('remark')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-1 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('implementasi.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection