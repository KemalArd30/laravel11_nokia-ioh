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
                <th class="text-center">IS13.1</th>
                <th class="text-center">OA Date</th>
                <th class="text-center">Status OA</th>
                <th class="text-center">NETGear MOS Status</th>
                <th class="text-center">NETGear MOS File Naming</th>
                <th class="text-center">Upload Date NETGear MOS PPM</th>
                <th class="text-center">URL NETGear MOS PPM</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($dataNetgearMosList as $netgearMosList)
                <tr>
                    <td class="text-center">{{ ($dataNetgearMosList->currentPage() - 1) * $dataNetgearMosList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                        <a href="{{ url('netgearMos/'.$netgearMosList->id_implementasi.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                            {{ $netgearMosList->site_id }}
                        </a>
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $netgearMosList->id_implementasi }}" aria-expanded="false" aria-controls="details-{{ $netgearMosList->id_implementasi }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                    <td class="text-center">{{ $netgearMosList->site_name }}</td>
                    <td class="text-center">{{ $netgearMosList->regional }}</td>
                    <td class="text-center">{{ $netgearMosList->project_year }}</td>
                    <td class="text-center">{{ $netgearMosList->phase_name }}</td>
                    <td class="text-center">{{ $netgearMosList->system_key }}</td>
                    <td class="text-center">{{ $netgearMosList->smp_id }}</td>
                    <td class="text-center">{{ $netgearMosList->status_site }}</td>
                    <td class="text-center">{{ $netgearMosList->is13_1_main_equipment_is_onsite }}</td>
                    <td class="text-center">{{ $netgearMosList->oa_date }}</td>
                    <td class="text-center">{{ $netgearMosList->status_oa }}</td>
                    <td class="text-center">{{ $netgearMosList->netgear_mos_status }}</td>
                    <td class="text-center">{{ $netgearMosList->netgear_mos_file_naming }}</td>
                    <td class="text-center">{{ $netgearMosList->upload_date_netgear_mos_ppm }}</td>
                    <td class="text-center">{{ $netgearMosList->url_netgear_mos_ppm }}</td>
                    <td class="text-center">{{ $netgearMosList->remark }}</td>
                    <td class="text-center">{{ $netgearMosList->last_update }}</td>
                </tr>
                <tr id="details-{{ $netgearMosList->id_implementasi }}" class="collapse no-border-collapse">
                    <td colspan="21">
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA:</strong> {{ $netgearMosList->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area:</strong> {{ $netgearMosList->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone:</strong> {{ $netgearMosList->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group:</strong> {{ $netgearMosList->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW:</strong> {{ $netgearMosList->sow }}
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
    {{ $dataNetgearMosList->appends(request()->except('page'))->links() }}
 </div>