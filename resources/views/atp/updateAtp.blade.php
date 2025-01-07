@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<form action="{{ route('atp.update', $dataAtpList->id_implementasi) }}" method="POST">
    @csrf
    <div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
        <div class="fs-2 mb-3 row">Update Take Data ATP</div>

        <div class="mb-2 row d-flex align-items-center">
            <label for="project_year" class="col-sm-2 col-form-label-sm">Project Year
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->project_year }}" aria-label="project_year" disabled readonly>
            </label>
            <label for="site_id" class="col-sm-2 col-form-label-sm">Site ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->site_id }}" aria-label="site_id" disabled readonly>
            </label>
            <label for="site_name" class="col-sm-2 col-form-label-sm">Site Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->site_name }}" aria-label="site_name" disabled readonly>
            </label>
            <label for="system_key" class="col-sm-2 col-form-label-sm">System Key
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->system_key }}" aria-label="system_key" disabled readonly>
            </label>
            <label for="smp_id" class="col-sm-2 col-form-label-sm">SMP-ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->smp_id }}" aria-label="smp_id" disabled readonly>
            </label>
            <label for="phase_name" class="col-sm-2 col-form-label-sm">Phase Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->phase_name }}" aria-label="phase_name" disabled readonly>
            </label>
        </div>
        <div class="mb-5 row d-flex align-items-center">
            <label for="regional" class="col-sm-2 col-form-label-sm">Region
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->regional }}" aria-label="regional" disabled readonly>
            </label>
            <label for="zone" class="col-sm-2 col-form-label-sm">Zone
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->zone }}" aria-label="zone" disabled readonly>
            </label>
            <label for="status_site" class="col-sm-2 col-form-label-sm">Status Site
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->status_site }}" aria-label="status_site" disabled readonly>
            </label>
            <label for="oa_date" class="col-sm-2 col-form-label-sm">On Air Date
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->oa_date }}" aria-label="oa_date" disabled readonly>
            </label>
            <label for="status_oa" class="col-sm-2 col-form-label-sm">Status OA
                <input class="form-control form-control-sm" type="text" value="{{ $dataAtpList->status_oa }}" aria-label="status_oa" disabled readonly>
            </label>
        </div>

        <div class="mb-3 row">
            <label for="status_task_atp_born" class="col-sm-2 col-form-label-sm">Status Task ATP Born</label>
            <div class="col-sm-10">
                <select class="form-select form-select-sm" name="status_task_atp_born" id="status_task_atp_born">
                    <option value="" disabled selected>Choose Status...</option>
                    <option value="NY Ready" {{ old('status_task_atp_born', $dataAtpList->status_task_atp_born) == 'NY Ready' ? 'selected' : '' }}>NY Ready</option>
                    <option value="Ready" {{ old('status_task_atp_born', $dataAtpList->status_task_atp_born) == 'Ready' ? 'selected' : '' }}>Ready</option>
                </select>
                @error('status_task_atp_born')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="status_take_data_atp_born" class="col-sm-2 col-form-label-sm">Status Take Data ATP Born</label>
            <div class="col-sm-10">
                <select class="form-select form-select-sm" name="status_take_data_atp_born" id="status_take_data_atp_born">
                    <option value="">Choose Status...</option>
                    <option value="On Going" {{ old('status_take_data_atp_born', $dataAtpList->status_take_data_atp_born) == 'On Going' ? 'selected' : '' }}>On Going</option>
                    <option value="Reject" {{ old('status_take_data_atp_born', $dataAtpList->status_take_data_atp_born) == 'Reject' ? 'selected' : '' }}>Reject</option>
                    <option value="Approved" {{ old('status_take_data_atp_born', $dataAtpList->status_take_data_atp_born) == 'Approved' ? 'selected' : '' }}>Approved</option>
                </select>
                @error('status_take_data_atp_born')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="atp_internal_review_date" class="col-sm-2 col-form-label-sm">ATP Internal Review Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control form-control-sm" name="atp_internal_review_date" id="atp_internal_review_date" value="{{ old('atp_internal_review_date', $dataAtpList->atp_internal_review_date) }}">
                @error('atp_internal_review_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="pic_atp_internal_review" class="col-sm-2 col-form-label-sm">PIC ATP Internal Review</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" name="pic_atp_internal_review" id="pic_atp_internal_review" value="{{ old('pic_atp_internal_review', $dataAtpList->pic_atp_internal_review) }}">
                @error('pic_atp_internal_review')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-5 row">
            <label for="remark" class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="remark" id="remark">{{ old('remark', $dataAtpList->remark) }}</textarea>
                @error('remark')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-1 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('atp.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection