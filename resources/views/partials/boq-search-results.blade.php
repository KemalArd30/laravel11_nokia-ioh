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
                <th class="text-center">BOQ File Naming</th>
                <th class="text-center">Upload Date BOQ PPM</th>
                <th class="text-center">URL BOQ PPM</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($dataBoqList as $boqList)
                <tr>
                    <td class="text-center">{{ ($dataBoqList->currentPage() - 1) * $dataBoqList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                        <a href="{{ url('boq/'.$boqList->id_implementasi.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                            {{ $boqList->site_id }}
                        </a>
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $boqList->id_implementasi }}" aria-expanded="false" aria-controls="details-{{ $boqList->id_implementasi }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                    <td class="text-center">{{ $boqList->site_name }}</td>
                    <td class="text-center">{{ $boqList->regional }}</td>
                    <td class="text-center">{{ $boqList->project_year }}</td>
                    <td class="text-center">{{ $boqList->phase_name }}</td>
                    <td class="text-center">{{ $boqList->system_key }}</td>
                    <td class="text-center">{{ $boqList->smp_id }}</td>
                    <td class="text-center">{{ $boqList->status_site }}</td>
                    <td class="text-center">{{ $boqList->oa_date }}</td>
                    <td class="text-center">{{ $boqList->status_oa }}</td>
                    <td class="text-center">{{ $boqList->boq_file_naming }}</td>
                    <td class="text-center">{{ $boqList->upload_date_boq_ppm }}</td>
                    <td class="text-center">{{ $boqList->url_boq_ppm }}</td>
                    <td class="text-center">{{ $boqList->remark }}</td>
                    <td class="text-center">{{ $boqList->last_update }}</td>
                </tr>
                <tr id="details-{{ $boqList->id_implementasi }}" class="collapse no-border-collapse">
                    <td colspan="21">
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA:</strong> {{ $boqList->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area:</strong> {{ $boqList->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone:</strong> {{ $boqList->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group:</strong> {{ $boqList->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW:</strong> {{ $boqList->sow }}
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
    {{ $dataBoqList->appends(request()->except('page'))->links() }}
 </div>