<div class="table-responsive">
    <table class="table table-nowrap">
        <thead class="wrap-text">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Site ID</th>
                <th class="text-center">Site Name</th>
                <th class="text-center">Region</th>
                <th class="text-center">Project Year</th>
                <th class="text-center">Phase Name</th>
                <th class="text-center">System Key</th>
                <th class="text-center">SMP-ID</th>
                <th class="text-center">Module ID</th>
                <th class="text-center">Status Site</th>
                <th class="text-center">Service Task</th>
                <th class="text-center">Doc Approved Date</th>
                <th class="text-center">EWCC Module %</th>
                <th class="text-center">SPO Number</th>
                <th class="text-center">SPO date</th>
                <th class="text-center">Target Completion</th>
                <th class="text-center">Actual Completion</th>
                <th class="text-center">Delay</th>
                <th class="text-center">WCC Assigned Date by Nokia</th>
                <th class="text-center">WCC Submit Date</th>
                <th class="text-center">WCC Reject Date</th>
                <th class="text-center">WCC Aging Submission</th>
                <th class="text-center">WCC Verification Date</th>
                <th class="text-center">WCC Approved Date</th>
                <th class="text-center">GR Date</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
                <th class="text-center">Updated by</th>
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
                    <td class="text-center">{{ $WccFullPayment->regional }}</td>
                    <td class="text-center">{{ $WccFullPayment->project_year }}</td>
                    <td class="text-center">{{ $WccFullPayment->phase_name }}</td>
                    <td class="text-center">{{ $WccFullPayment->system_key }}</td>
                    <td class="text-center">{{ $WccFullPayment->smp_id }}</td>
                    <td class="text-center">{{ $WccFullPayment->ewcc_module_id }}</td>
                    <td class="text-center">{{ $WccFullPayment->tss.status_site }}</td>
                    <td class="text-center">{{ $WccFullPayment->service_task }}</td>
                    <td class="text-center">{{ $WccFullPayment->tssr_done }}</td>
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
                    <td class="text-center">{{ $WccFullPayment->remark }}</td>
                    <td class="text-center">{{ $WccFullPayment->last_update }}</td>
                    <td class="text-center">{{ $WccFullPayment->updated_by }}</td>
                </tr>
                <tr id="details-{{ $WccFullPayment->id_scope }}" class="collapse no-border-collapse">
                    <td colspan="21">
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA:</strong> {{ $WccFullPayment->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area:</strong> {{ $WccFullPayment->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone:</strong> {{ $WccFullPayment->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group:</strong> {{ $WccFullPayment->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW:</strong> {{ $WccFullPayment->sow }}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $i++; ?>
            @empty
                <tr>
                    <td colspan="50" class="text-center">No Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="p-2">
    {{ $dataWccFullPayment->appends(request()->except('page'))->links() }}
 </div>