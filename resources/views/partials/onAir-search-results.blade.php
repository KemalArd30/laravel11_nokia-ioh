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
                <th class="text-center">SMP-ID</th>
                <th class="text-center">Status Site</th>
                <th class="text-center">MS13</th>
                <th class="text-center">IS13.1</th>
                <th class="text-center">MS15</th>
                <th class="text-center">IS15.1</th>
                <th class="text-center">IS15.4</th>
                <th class="text-center">MS16</th>
                <th class="text-center">MS17</th>
                <th class="text-center">OA Date</th>
                <th class="text-center">Status OA</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($dataImplementasiList as $implementasiList)
                <tr>
                    <td class="text-center">{{ ($dataImplementasiList->currentPage() - 1) * $dataImplementasiList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                        <a href="{{ url('implementasi/'.$implementasiList->id_implementasi.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                            {{ $implementasiList->site_id }}
                        </a>
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $implementasiList->id_implementasi }}" aria-expanded="false" aria-controls="details-{{ $implementasiList->id_implementasi }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                    <td class="text-center">{{ $implementasiList->site_name }}</td>
                    <td class="text-center">{{ $implementasiList->regional }}</td>
                    <td class="text-center">{{ $implementasiList->project_year }}</td>
                    <td class="text-center">{{ $implementasiList->phase_name }}</td>
                    <td class="text-center">{{ $implementasiList->smp_id }}</td>
                    <td class="text-center">{{ $implementasiList->status_site }}</td>
                    <td class="text-center">{{ $implementasiList->ms13_ready_for_implementation }}</td>
                    <td class="text-center">{{ $implementasiList->is13_1_main_equipment_is_onsite }}</td>
                    <td class="text-center">{{ $implementasiList->ms15_implementation_starts }}</td>
                    <td class="text-center">{{ $implementasiList->is15_1_installation_complete }}</td>
                    <td class="text-center">{{ $implementasiList->is15_4_integration_complete }}</td>
                    <td class="text-center">{{ $implementasiList->ms16_implementation_ends }}</td>
                    <td class="text-center">{{ $implementasiList->ms17_site_acceptance }}</td>
                    <td class="text-center">{{ $implementasiList->oa_date }}</td>
                    <td class="text-center">{{ $implementasiList->status_oa }}</td>
                    <td class="text-center">{{ $implementasiList->remark }}</td>
                    <td class="text-center">{{ $implementasiList->last_update }}</td>
                </tr>
                <tr id="details-{{ $implementasiList->id_implementasi }}" class="collapse no-border-collapse">
                    <td colspan="21">
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>System Key:</strong> {{ $implementasiList->system_key }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA:</strong> {{ $implementasiList->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area:</strong> {{ $implementasiList->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone:</strong> {{ $implementasiList->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group:</strong> {{ $implementasiList->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW:</strong> {{ $implementasiList->sow }}
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
    {{ $dataImplementasiList->appends(request()->except('page'))->links() }}
 </div>