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
                <th class="text-center">Status Site</th>
                <th class="text-center">OA Date</th>
                <th class="text-center">Status OA</th>
                <th class="text-center">Status Task ATP Born</th>
                <th class="text-center">Status Take Data ATP Born</th>
                <th class="text-center">ATP Internal Review Date</th>
                <th class="text-center">PIC ATP Internal Review</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($dataAtpList as $atpList)
                <tr>
                    <td class="text-center">{{ ($dataAtpList->currentPage() - 1) * $dataAtpList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                        <a href="{{ url('atp/'.$atpList->id_implementasi.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                            {{ $atpList->site_id }}
                        </a>
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $atpList->id_implementasi }}" aria-expanded="false" aria-controls="details-{{ $atpList->id_implementasi }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                    <td class="text-center">{{ $atpList->site_name }}</td>
                    <td class="text-center">{{ $atpList->regional }}</td>
                    <td class="text-center">{{ $atpList->project_year }}</td>
                    <td class="text-center">{{ $atpList->phase_name }}</td>
                    <td class="text-center">{{ $atpList->system_key }}</td>
                    <td class="text-center">{{ $atpList->smp_id }}</td>
                    <td class="text-center">{{ $atpList->status_site }}</td>
                    <td class="text-center">{{ $atpList->oa_date }}</td>
                    <td class="text-center">{{ $atpList->status_oa }}</td>
                    <td class="text-center">{{ $atpList->status_task_atp_born }}</td>
                    <td class="text-center">{{ $atpList->status_take_data_atp_born }}</td>
                    <td class="text-center">{{ $atpList->atp_internal_review_date }}</td>
                    <td class="text-center">{{ $atpList->pic_atp_internal_review }}</td>
                    <td class="text-center">{{ $atpList->remark }}</td>
                    <td class="text-center">{{ $atpList->last_update }}</td>
                </tr>
                <tr id="details-{{ $atpList->id_implementasi }}" class="collapse no-border-collapse">
                    <td colspan="21">
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA:</strong> {{ $atpList->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area:</strong> {{ $atpList->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone:</strong> {{ $atpList->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group:</strong> {{ $atpList->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW:</strong> {{ $atpList->sow }}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $i++; ?>
            @empty
                <tr>
                    <td colspan="21" class="text-center">No Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="p-2">
    {{ $dataAtpList->appends(request()->except('page'))->links() }}
 </div>