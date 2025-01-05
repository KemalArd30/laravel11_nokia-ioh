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
                <th class="text-center">ATF File Naming</th>
                <th class="text-center">Upload Date ATF PPM</th>
                <th class="text-center">URL ATF PPM</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($dataAtfList as $atfList)
                <tr>
                    <td class="text-center">{{ ($dataAtfList->currentPage() - 1) * $dataAtfList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                        <a href="{{ url('atf/'.$atfList->id_implementasi.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                            {{ $atfList->site_id }}
                        </a>
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $atfList->id_implementasi }}" aria-expanded="false" aria-controls="details-{{ $atfList->id_implementasi }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                    <td class="text-center">{{ $atfList->site_name }}</td>
                    <td class="text-center">{{ $atfList->regional }}</td>
                    <td class="text-center">{{ $atfList->project_year }}</td>
                    <td class="text-center">{{ $atfList->phase_name }}</td>
                    <td class="text-center">{{ $atfList->system_key }}</td>
                    <td class="text-center">{{ $atfList->smp_id }}</td>
                    <td class="text-center">{{ $atfList->status_site }}</td>
                    <td class="text-center">{{ $atfList->oa_date }}</td>
                    <td class="text-center">{{ $atfList->status_oa }}</td>
                    <td class="text-center">{{ $atfList->atf_file_naming }}</td>
                    <td class="text-center">{{ $atfList->upload_date_atf_ppm }}</td>
                    <td class="text-center">{{ $atfList->url_atf_ppm }}</td>
                    <td class="text-center">{{ $atfList->remark }}</td>
                    <td class="text-center">{{ $atfList->last_update }}</td>
                </tr>
                <tr id="details-{{ $atfList->id_implementasi }}" class="collapse no-border-collapse">
                    <td colspan="21">
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA:</strong> {{ $atfList->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area:</strong> {{ $atfList->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone:</strong> {{ $atfList->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group:</strong> {{ $atfList->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW:</strong> {{ $atfList->sow }}
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
    {{ $dataAtfList->appends(request()->except('page'))->links() }}
 </div>