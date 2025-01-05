@extends('layouts.app')

@section('title', 'WCC Full Payment')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<link href="{{ asset('css/sub-content/sub-content.css') }}" rel="stylesheet">
<link href="{{ asset('css/table/table.css') }}" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/editable/bootstrap-table-editable.min.js"></script>

<div class="bg-body rounded shadow-sm mt-2 p-0">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="sub-content pb-0 pt-0">
        <ul class="item-content">
            <li><a href="#" id="refresh-link" data-refresh-url=""><i class="fa-solid fa-sync-alt"></i> Refresh</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#searchModal" class="filter"><i class="fa-solid fa-filter"></i> Filter</a></li>
            <li><a href="#" class="export-data"><i class="fa-solid fa-file-export"></i> Export Data</a></li>
        </ul>
    </div>

    <div class="table-responsive">
        <table 
            id="table" 
            class="table table-bordered table-hover"
            data-toggle="table"
            data-show-columns-toggle-all="true"
            data-sort-name="last_update"
            data-sort-order="desc"
            data-search="true"
            data-show-columns-search="true"
            data-show-columns="true"
            data-fixed-columns="true"
            data-fixed-number="4"
            data-search-highlight="true"
            data-loading-font-size="16px">
            <thead class="wrap-text">
                <tr>
                    <th class="text-center" data-field="no" data-sortable="true">No</th>
                    <th class="text-center" data-field="site_id" data-sortable="true">Site ID</th>
                    <th class="text-center" data-field="site_name" data-sortable="true">Site Name</th>
                    <th class="text-center" data-field="system_key" data-sortable="true">System Key</th>
                    <th class="text-center" data-field="smp_id" data-sortable="true">SMP-ID</th>
                    <th class="text-center" data-field="ewcc_module_id" data-sortable="true">Module ID</th>
                    <th class="text-center" data-field="region" data-sortable="true">Region</th>
                    <th class="text-center" data-field="project_year" data-sortable="true">Project Year</th>
                    <th class="text-center" data-field="phase_name" data-sortable="true">Phase Name</th>
                    <th class="text-center" data-field="display_status_site" data-sortable="true">Status Site</th>
                    {{-- <th data-field="status" data-editable="true" data-editable-type="select"
                data-editable-source="[{value: 'Active', text: 'Active'}, {value: 'Inactive', text: 'Inactive'}]">
                Status
            </th> --}}
                    <th class="text-center" data-field="service_task" data-sortable="true">Service Task</th>
                    <th class="text-center" data-field="display_doc_approved_date" data-sortable="true">Doc Approved Date</th>
                    <th class="text-center" data-field="ewcc_module_percentage" data-sortable="true">EWCC Module %</th>
                    <th class="text-center" data-field="spo_number" data-sortable="true">SPO Number</th>
                    <th class="text-center" data-field="spo_date" data-sortable="true">SPO date</th>
                    <th class="text-center" data-field="target_time_of_completion" data-sortable="true">Target Completion</th>
                    <th class="text-center" data-field="actual_time_of_completion" data-sortable="true">Actual Completion</th>
                    <th class="text-center" data-field="delay_justification" data-sortable="true">Delay</th>
                    <th class="text-center" data-field="wcc_assign_by_nokia" data-sortable="true">WCC Assigned Date by Nokia</th>
                    <th class="text-center" data-field="wcc_submit_date" data-sortable="true">WCC Submit Date</th>
                    <th class="text-center" data-field="wcc_reject_date" data-sortable="true">WCC Reject Date</th>
                    <th class="text-center" data-field="aging_submition" data-sortable="true">WCC Aging Submission</th>
                    <th class="text-center" data-field="wcc_verification_date" data-sortable="true">WCC Verification Date</th>
                    <th class="text-center" data-field="wcc_approve_date" data-sortable="true">WCC Approved Date</th>
                    <th class="text-center" data-field="gr_status" data-sortable="true">GR Date</th>
                    <th class="text-center" data-field="wcc_status" data-sortable="true">WCC Status</th>
                    <th class="text-center" data-field="remark" data-sortable="true">Remark</th>
                    <th class="text-center" data-field="last_update" data-sortable="true">Last Update</th>
                    <th class="text-center" data-field="updated_by" data-sortable="true">Updated by</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @forelse ($dataWccFullPayment as $WccFullPayment)
                    <tr>
                        <td class="text-center">{{ ($dataWccFullPayment->currentPage() - 1) * $dataWccFullPayment->perPage() + $loop->iteration }}</td>
                        <td class="text-center">
                            <a href="{{ url('acceptance/'.$WccFullPayment->id_scope.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                                {{ $WccFullPayment->site_id }}
                            </a>
                            <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $WccFullPayment->id_scope }}" aria-expanded="false" aria-controls="details-{{ $WccFullPayment->id_scope }}">
                                <i class="fa-solid fa-caret-down"></i>
                            </button>
                        </td>
                        <td class="text-center">{{ $WccFullPayment->site_name }}</td>
                        <td class="text-center">{{ $WccFullPayment->system_key }}</td>
                        <td class="text-center">{{ $WccFullPayment->smp_id }}</td>
                        <td class="text-center">{{ $WccFullPayment->ewcc_module_id }}</td>
                        <td class="text-center">{{ $WccFullPayment->regional }}</td>
                        <td class="text-center">{{ $WccFullPayment->project_year }}</td>
                        <td class="text-center">{{ $WccFullPayment->phase_name }}</td>
                        <td class="text-center">{{ $WccFullPayment->display_status_site }}</td>
                        <td class="text-center">{{ $WccFullPayment->service_task }}</td>
                        <td class="text-center">{{ $WccFullPayment->display_doc_approved_date }}</td>
                        <td class="text-center">{{ $WccFullPayment->ewcc_module_percentage }}</td>
                        <td class="text-center">{{ $WccFullPayment->spo_number }}</td>
                        <td class="text-center">{{ $WccFullPayment->spo_date }}</td>
                        <td class="text-center">{{ $WccFullPayment->target_time_of_completion }}</td>
                        <td class="text-center">{{ $WccFullPayment->actual_time_of_completion }}</td>
                        <td class="text-center">{{ $WccFullPayment->delay_justification }}</td>
                        <td class="text-center">{{ $WccFullPayment->wcc_assign_by_nokia }}</td>
                        <td class="text-center">{{ $WccFullPayment->wcc_submit_date }}</td>
                        <td class="text-center">{{ $WccFullPayment->wcc_reject_date }}</td>
                        <td class="text-center">{{ $WccFullPayment->aging_submition }}</td>
                        <td class="text-center">{{ $WccFullPayment->wcc_verification_date }}</td>
                        <td class="text-center">{{ $WccFullPayment->wcc_approve_date }}</td>
                        <td class="text-center">{{ $WccFullPayment->gr_status }}</td>
                        <td class="text-center">{{ $WccFullPayment->wcc_status }}</td>
                        <td class="text-center">{{ $WccFullPayment->remark }}</td>
                        <td class="text-center">{{ $WccFullPayment->last_update }}</td>
                        <td class="text-center">{{ $WccFullPayment->updated_by }}</td>
                    </tr>
                    <tr id="details-{{ $WccFullPayment->id_scope }}" class="collapse no-border-collapse">
                        <td colspan="28">
                            <div class="text-start" style="padding:5px;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <strong>COA:</strong> {{ $WccFullPayment->coa }}
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <strong>Area:</strong> {{ $WccFullPayment->area }}
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <strong>Site Address:</strong> {{ $WccFullPayment->site_address }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <strong>PO Number:</strong> {{ $WccFullPayment->po_number }}
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <strong>PO Date:</strong> {{ $WccFullPayment->po_date }}
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <strong>Contract Amount:</strong> {{ $WccFullPayment->contract_amount }}
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="28" class="text-center">No data available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection