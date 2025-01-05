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
                <th class="text-center">LLD/NDB File Naming</th>
                <th class="text-center">Upload Date LLD/NDB PPM</th>
                <th class="text-center">URL LLD/NDB PPM</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($dataLldNdbList as $lldNdbList)
                <tr>
                    <td class="text-center">{{ ($dataLldNdbList->currentPage() - 1) * $dataLldNdbList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                        <a href="{{ url('lldNdb/'.$lldNdbList->id_implementasi.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                            {{ $lldNdbList->site_id }}
                        </a>
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $lldNdbList->id_implementasi }}" aria-expanded="false" aria-controls="details-{{ $lldNdbList->id_implementasi }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                    <td class="text-center">{{ $lldNdbList->site_name }}</td>
                    <td class="text-center">{{ $lldNdbList->regional }}</td>
                    <td class="text-center">{{ $lldNdbList->project_year }}</td>
                    <td class="text-center">{{ $lldNdbList->phase_name }}</td>
                    <td class="text-center">{{ $lldNdbList->system_key }}</td>
                    <td class="text-center">{{ $lldNdbList->smp_id }}</td>
                    <td class="text-center">{{ $lldNdbList->status_site }}</td>
                    <td class="text-center">{{ $lldNdbList->oa_date }}</td>
                    <td class="text-center">{{ $lldNdbList->status_oa }}</td>
                    <td class="text-center">{{ $lldNdbList->lld_file_naming }}</td>
                    <td class="text-center">{{ $lldNdbList->upload_date_lld_ppm }}</td>
                    <td class="text-center">{{ $lldNdbList->url_lld_ppm }}</td>
                    <td class="text-center">{{ $lldNdbList->remark }}</td>
                    <td class="text-center">{{ $lldNdbList->last_update }}</td>
                </tr>
                <tr id="details-{{ $lldNdbList->id_implementasi }}" class="collapse no-border-collapse">
                    <td colspan="21">
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA:</strong> {{ $lldNdbList->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area:</strong> {{ $lldNdbList->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone:</strong> {{ $lldNdbList->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group:</strong> {{ $lldNdbList->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW:</strong> {{ $lldNdbList->sow }}
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
    {{ $dataLldNdbList->appends(request()->except('page'))->links() }}
 </div>