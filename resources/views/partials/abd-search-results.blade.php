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
                <th class="text-center">Status Take Data ATP Born</th>
                <th class="text-center">ATP Internal Review Date</th>
                <th class="text-center">ABDW File Naming</th>
                <th class="text-center">Upload Date ABDW PPM</th>
                <th class="text-center">URL ABDW PPM</th>
                <th class="text-center">ABDN File Naming</th>
                <th class="text-center">Upload Date ABDN PPM</th>
                <th class="text-center">URL ABDN PPM</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($dataAbdList as $abdList)
                <tr>
                    <td class="text-center">{{ ($dataAbdList->currentPage() - 1) * $dataAbdList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                        <a href="{{ url('abd/'.$abdList->id_implementasi.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                            {{ $abdList->site_id }}
                        </a>
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $abdList->id_implementasi }}" aria-expanded="false" aria-controls="details-{{ $abdList->id_implementasi }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                    <td class="text-center">{{ $abdList->site_name }}</td>
                    <td class="text-center">{{ $abdList->regional }}</td>
                    <td class="text-center">{{ $abdList->project_year }}</td>
                    <td class="text-center">{{ $abdList->phase_name }}</td>
                    <td class="text-center">{{ $abdList->system_key }}</td>
                    <td class="text-center">{{ $abdList->smp_id }}</td>
                    <td class="text-center">{{ $abdList->status_site }}</td>
                    <td class="text-center">{{ $abdList->oa_date }}</td>
                    <td class="text-center">{{ $abdList->status_oa }}</td>
                    <td class="text-center">{{ $abdList->status_take_data_atp_born }}</td>
                    <td class="text-center">{{ $abdList->atp_internal_review_date }}</td>
                    <td class="text-center">{{ $abdList->abdw_file_naming }}</td>
                    <td class="text-center">{{ $abdList->upload_date_abdw_ppm }}</td>
                    <td class="text-center">{{ $abdList->url_abdw_ppm }}</td>
                    <td class="text-center">{{ $abdList->abdn_file_naming }}</td>
                    <td class="text-center">{{ $abdList->upload_date_abdn_ppm }}</td>
                    <td class="text-center">{{ $abdList->url_abdn_ppm }}</td>
                    <td class="text-center">{{ $abdList->remark }}</td>
                    <td class="text-center">{{ $abdList->last_update }}</td>
                </tr>
                <tr id="details-{{ $abdList->id_implementasi }}" class="collapse no-border-collapse">
                    <td colspan="21">
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA:</strong> {{ $abdList->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area:</strong> {{ $abdList->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone:</strong> {{ $abdList->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group:</strong> {{ $abdList->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW:</strong> {{ $abdList->sow }}
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
    {{ $dataAbdList->appends(request()->except('page'))->links() }}
 </div>