@extends('layouts.app')

@section('content')

<script src="{{ asset('js/openLink.js') }}"></script>

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<form action="{{ route('acceptance.update', $dataAcceptanceList->id_implementasi) }}" method="POST">
    @csrf
    <div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
        <div class="fs-2 mb-3 row">Update Acceptance</div>

        <div class="mb-2 row d-flex align-items-center">
            <label for="project_year" class="col-sm-2 col-form-label-sm">Project Year
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->project_year }}" aria-label="project_year" disabled readonly>
            </label>
            <label for="site_id" class="col-sm-2 col-form-label-sm">Site ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->site_id }}" aria-label="site_id" disabled readonly>
            </label>
            <label for="site_name" class="col-sm-2 col-form-label-sm">Site Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->site_name }}" aria-label="site_name" disabled readonly>
            </label>
            <label for="system_key" class="col-sm-2 col-form-label-sm">System Key
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->system_key }}" aria-label="system_key" disabled readonly>
            </label>
            <label for="smp_id" class="col-sm-2 col-form-label-sm">SMP-ID
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->smp_id }}" aria-label="smp_id" disabled readonly>
            </label>
            <label for="phase_name" class="col-sm-2 col-form-label-sm">Phase Name
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->phase_name }}" aria-label="phase_name" disabled readonly>
            </label>
        </div>
        <div class="mb-2 row d-flex align-items-center">
            <label for="regional" class="col-sm-2 col-form-label-sm">Region
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->regional }}" aria-label="regional" disabled readonly>
            </label>
            <label for="zone" class="col-sm-2 col-form-label-sm">Zone
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->zone }}" aria-label="zone" disabled readonly>
            </label>
            <label for="status_site" class="col-sm-2 col-form-label-sm">Status Site
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->status_site }}" aria-label="status_site" disabled readonly>
            </label>
            <label for="tssr_done" class="col-sm-2 col-form-label-sm">TSS Approved
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->tssr_done }}" aria-label="tssr_done" disabled readonly>
            </label>
            <label for="oa_date" class="col-sm-2 col-form-label-sm">On Air Date
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->oa_date }}" aria-label="oa_date" disabled readonly>
            </label>
            <label for="status_oa" class="col-sm-2 col-form-label-sm">Status OA
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->status_oa }}" aria-label="status_oa" disabled readonly>
            </label>
        </div>
        <div class="mb-2 row d-flex align-items-center">
            <label for="upload_date_sid_ppm" class="col-sm-2 col-form-label-sm">Upload Date SID PPM
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->upload_date_sid_ppm }}" aria-label="upload_date_sid_ppm" disabled readonly>
            </label>
            <label for="netgear_mos_status" class="col-sm-2 col-form-label-sm">NETGear MOS Status
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->netgear_mos_status }}" aria-label="netgear_mos_status" disabled readonly>
            </label>
            <label for="upload_date_lld_ppm" class="col-sm-2 col-form-label-sm">Upload Date LLD/NDB PPM
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->upload_date_lld_ppm }}" aria-label="upload_date_lld_ppm" disabled readonly>
            </label>
            <label for="upload_date_abdn_ppm" class="col-sm-2 col-form-label-sm">Upload Date ABDN PPM
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->upload_date_abdn_ppm }}" aria-label="upload_date_abdn_ppm" disabled readonly>
            </label>
            <label for="upload_date_boq_ppm" class="col-sm-2 col-form-label-sm">Upload Date BOQ PPM
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->upload_date_boq_ppm }}" aria-label="upload_date_boq_ppm" disabled readonly>
            </label>
            <label for="upload_date_atf_ppm" class="col-sm-2 col-form-label-sm">Upload Date ATF PPM
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->upload_date_atf_ppm }}" aria-label="upload_date_atf_ppm" disabled readonly>
            </label>
        </div>
        <div class="mb-5 row d-flex align-items-center">
            <label for="status_take_data_atp_born" class="col-sm-2 col-form-label-sm">Status Take Data ATP Born
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->status_take_data_atp_born }}" aria-label="status_take_data_atp_born" disabled readonly>
            </label>
            <label for="atp_internal_review_date" class="col-sm-2 col-form-label-sm">ATP Internal Review Date
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->atp_internal_review_date }}" aria-label="atp_internal_review_date" disabled readonly>
            </label>
            <label for="pic_atp_internal_review" class="col-sm-2 col-form-label-sm">PIC ATP Internal Review
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->pic_atp_internal_review }}" aria-label="pic_atp_internal_review" disabled readonly>
            </label>
        </div>

        <div class="fs-5 mb-3 row">Supporting Doc Acceptance</div>

        <div class="mb-2 row">
            <label for="url_tssr_ppm" class="col-sm-2 col-form-label-sm">URL TSSR PPM</label>
            <div class="col-sm-10 d-flex align-items-center">
                <input class="form-control form-control-sm me-2" type="text" value="{{ $dataAcceptanceList->url_tssr_ppm }}" id="url_tssr_ppm" aria-label="url_tssr_ppm" disabled readonly>
                <i class="fa-solid fa-clipboard me-2" style="cursor: pointer;" onclick="copyToClipboard('url_tssr_ppm')" title="Copy URL"></i>
                <i class="fa-solid fa-link" style="cursor: pointer;" onclick="openUrl('url_tssr_ppm')" title="Open URL"></i>
            </div>
        </div>
        <div class="mb-2 row">
            <label for="url_sid_ppm" class="col-sm-2 col-form-label-sm">URL SID PPM</label>
            <div class="col-sm-10 d-flex align-items-center">
                <input class="form-control form-control-sm me-2" type="text" value="{{ $dataAcceptanceList->url_sid_ppm }}" id="url_sid_ppm" aria-label="url_sid_ppm" disabled readonly>
                <i class="fa-solid fa-clipboard me-2" style="cursor: pointer;" onclick="copyToClipboard('url_sid_ppm')" title="Copy URL"></i>
                <i class="fa-solid fa-link" style="cursor: pointer;" onclick="openUrl('url_sid_ppm')" title="Open URL"></i>
            </div>
        </div>
        <div class="mb-2 row">
            <label for="url_netgear_mos_ppm" class="col-sm-2 col-form-label-sm">URL NETGear MOS PPM</label>
            <div class="col-sm-10 d-flex align-items-center">
                <input class="form-control form-control-sm me-2" type="text" value="{{ $dataAcceptanceList->url_netgear_mos_ppm }}" id="url_netgear_mos_ppm" aria-label="url_netgear_mos_ppm" disabled readonly>
                <i class="fa-solid fa-clipboard me-2" style="cursor: pointer;" onclick="copyToClipboard('url_netgear_mos_ppm')" title="Copy URL"></i>
                <i class="fa-solid fa-link" style="cursor: pointer;" onclick="openUrl('url_netgear_mos_ppm')" title="Open URL"></i>
            </div>
        </div>
        <div class="mb-2 row">
            <label for="url_lld_ppm" class="col-sm-2 col-form-label-sm">URL LLD/NDB PPM</label>
            <div class="col-sm-10 d-flex align-items-center">
                <input class="form-control form-control-sm me-2" type="text" value="{{ $dataAcceptanceList->url_lld_ppm }}" id="url_lld_ppm" aria-label="url_lld_ppm" disabled readonly>
                <i class="fa-solid fa-clipboard me-2" style="cursor: pointer;" onclick="copyToClipboard('url_lld_ppm')" title="Copy URL"></i>
                <i class="fa-solid fa-link" style="cursor: pointer;" onclick="openUrl('url_lld_ppm')" title="Open URL"></i>
            </div>
        </div>
        <div class="mb-2 row">
            <label for="url_abdn_ppm" class="col-sm-2 col-form-label-sm">URL ABDN PPM</label>
            <div class="col-sm-10 d-flex align-items-center">
                <input class="form-control form-control-sm me-2" type="text" value="{{ $dataAcceptanceList->url_abdn_ppm }}" id="url_abdn_ppm" aria-label="url_abdn_ppm" disabled readonly>
                <i class="fa-solid fa-clipboard me-2" style="cursor: pointer;" onclick="copyToClipboard('url_abdn_ppm')" title="Copy URL"></i>
                <i class="fa-solid fa-link" style="cursor: pointer;" onclick="openUrl('url_abdn_ppm')" title="Open URL"></i>
            </div>
        </div>
        <div class="mb-2 row">
            <label for="url_boq_ppm" class="col-sm-2 col-form-label-sm">URL BOQ PPM</label>
            <div class="col-sm-10 d-flex align-items-center">
                <input class="form-control form-control-sm me-2" type="text" value="{{ $dataAcceptanceList->url_boq_ppm }}" id="url_boq_ppm" aria-label="url_boq_ppm" disabled readonly>
                <i class="fa-solid fa-clipboard me-2" style="cursor: pointer;" onclick="copyToClipboard('url_boq_ppm')" title="Copy URL"></i>
                <i class="fa-solid fa-link" style="cursor: pointer;" onclick="openUrl('url_boq_ppm')" title="Open URL"></i>
            </div>
        </div>
        <div class="mb-5 row">
            <label for="url_atf_ppm" class="col-sm-2 col-form-label-sm">URL ATF PPM</label>
            <div class="col-sm-10 d-flex align-items-center">
                <input class="form-control form-control-sm me-2" type="text" value="{{ $dataAcceptanceList->url_atf_ppm }}" id="url_atf_ppm" aria-label="url_atf_ppm" disabled readonly>
                <i class="fa-solid fa-clipboard me-2" style="cursor: pointer;" onclick="copyToClipboard('url_atf_ppm')" title="Copy URL"></i>
                <i class="fa-solid fa-link" style="cursor: pointer;" onclick="openUrl('url_atf_ppm')" title="Open URL"></i>
            </div>
        </div>

        <div class="fs-5 mb-3 row">Submission Doc Acceptance</div>

        <div class="mb-2 row">
            <label for="atp_submit_date" class="col-sm-2 col-form-label-sm">ATP Submit Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control form-control-sm me-2" name="atp_submit_date" id="atp_submit_date" value="{{ old('atp_submit_date', $dataAcceptanceList->atp_submit_date) }}">
                @error('atp_submit_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-2 row">
            <label for="atp_reject_date" class="col-sm-2 col-form-label-sm">ATP Reject Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control form-control-sm me-2" name="atp_reject_date" id="atp_reject_date" value="{{ old('atp_reject_date', $dataAcceptanceList->atp_reject_date) }}">
                @error('atp_reject_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-5 row">
            <label for="atp_rectification_date" class="col-sm-2 col-form-label-sm">ATP Rectification Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control form-control-sm me-2" name="atp_rectification_date" id="atp_rectification_date" value="{{ old('atp_rectification_date', $dataAcceptanceList->atp_rectification_date) }}">
                @error('atp_rectification_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="fs-5 mb-3 row">Status Acceptance</div>

        <div class="mb-5 row">
            <label for="atp_status" class="col-sm-2 col-form-label-sm">ATP Status</label>
            <div class="col-sm-10">
                <select class="form-select form-select-sm" name="atp_status" id="atp_status">
                    <option value="" disabled selected>Choose Status...</option>
                    <option value="NY Complete" {{ old('atp_status', $dataAcceptanceList->atp_status) == 'NY Complete' ? 'selected' : '' }}>NY Complete</option>
                    <option value="Pending Submit" {{ old('atp_status', $dataAcceptanceList->atp_status) == 'Pending Submit' ? 'selected' : '' }}>Pending Submit</option>
                    <option value="On Review" {{ old('atp_status', $dataAcceptanceList->atp_status) == 'On Review' ? 'selected' : '' }}>On Review</option>
                    <option value="Rejected" {{ old('atp_status', $dataAcceptanceList->atp_status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="Approved" {{ old('atp_status', $dataAcceptanceList->atp_status) == 'Approved' ? 'selected' : '' }}>Approved</option>
                </select>
                @error('atp_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="fs-5 mb-3 row">Acceptance Approved</div>

        <div class="mb-2 row">
            <label for="atp_file_naming" class="col-sm-2 col-form-label-sm">ATP File Naming</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" type="text" value="{{ $dataAcceptanceList->atp_file_naming }}" aria-label="atp_file_naming" disabled readonly>
            </div>
        </div>
        <div class="mb-2 row">
            <label for="atp_approved_date" class="col-sm-2 col-form-label-sm">ATP Approved Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control form-control-sm" name="atp_approved_date" id="atp_approved_date" value="{{ old('atp_approved_date', $dataAcceptanceList->atp_approved_date) }}">
                @error('atp_approved_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-2 row">
            <label for="url_atp_ppm" class="col-sm-2 col-form-label-sm">URL ATP PPM</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" name="url_atp_ppm" id="url_atp_ppm" value="{{ old('url_atp_ppm', $dataAcceptanceList->url_atp_ppm) }}">
                @error('url_atp_ppm')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-5 row">
            <label for="remark" class="col-sm-2 col-form-label">Remark</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="remark" id="remark">{{ old('remark', $dataAcceptanceList->remark) }}</textarea>
                @error('remark')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-1 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('acceptance.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection