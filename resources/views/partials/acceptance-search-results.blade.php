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
                <th class="text-center">TSS Approved</th>
                <th class="text-center">OA Date</th>
                <th class="text-center">Status OA</th>
                <th class="text-center">SID Upload Date PPM</th>
                <th class="text-center">NETGear MOS Status</th>
                <th class="text-center">LLD/NDB Upload Date PPM</th>
                <th class="text-center">ABDN Upload Date PPM</th>
                <th class="text-center">BOQ Upload Date PPM</th>
                <th class="text-center">ATF Upload Date PPM</th>
                <th class="text-center">Status Take Data ATP Born</th>
                <th class="text-center">ATP Internal Review Date</th>
                <th class="text-center">PIC ATP Internal Review</th>
                <th class="text-center">ATP Submit Date</th>
                <th class="text-center">ATP Reject Date</th>
                <th class="text-center">ATP Rectification Date</th>
                <th class="text-center">ATP Approved Date</th>
                <th class="text-center">ATP Status</th>
                <th class="text-center">ATP File Naming</th>
                <th class="text-center">Url ATP PPM</th>
                <th class="text-center">Aging OA to ATP Submit</th>
                <th class="text-center">Total Aging ATP</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($dataAcceptanceList as $acceptanceList)
                <tr>
                    <td class="text-center">{{ ($dataAcceptanceList->currentPage() - 1) * $dataAcceptanceList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                        <a href="{{ url('acceptance/'.$acceptanceList->id_implementasi.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                            {{ $acceptanceList->site_id }}
                        </a>
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $acceptanceList->id_implementasi }}" aria-expanded="false" aria-controls="details-{{ $acceptanceList->id_implementasi }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                    <td class="text-center">{{ $acceptanceList->site_name }}</td>
                    <td class="text-center">{{ $acceptanceList->regional }}</td>
                    <td class="text-center">{{ $acceptanceList->project_year }}</td>
                    <td class="text-center">{{ $acceptanceList->phase_name }}</td>
                    <td class="text-center">{{ $acceptanceList->system_key }}</td>
                    <td class="text-center">{{ $acceptanceList->smp_id }}</td>
                    <td class="text-center">{{ $acceptanceList->status_site }}</td>
                    <td class="text-center">{{ $acceptanceList->tssr_done }}</td>
                    <td class="text-center">{{ $acceptanceList->oa_date }}</td>
                    <td class="text-center">{{ $acceptanceList->status_oa }}</td>
                    <td class="text-center">{{ $acceptanceList->upload_date_sid_ppm }}</td>
                    <td class="text-center">{{ $acceptanceList->netgear_mos_status }}</td>
                    <td class="text-center">{{ $acceptanceList->upload_date_lld_ppm }}</td>
                    <td class="text-center">{{ $acceptanceList->upload_date_abdn_ppm }}</td>
                    <td class="text-center">{{ $acceptanceList->upload_date_boq_ppm }}</td>
                    <td class="text-center">{{ $acceptanceList->upload_date_atf_ppm }}</td>
                    <td class="text-center">{{ $acceptanceList->status_take_data_atp_born }}</td>
                    <td class="text-center">{{ $acceptanceList->atp_internal_review_date }}</td>
                    <td class="text-center">{{ $acceptanceList->pic_atp_internal_review }}</td>
                    <td class="text-center">{{ $acceptanceList->atp_submit_date }}</td>
                    <td class="text-center">{{ $acceptanceList->atp_reject_date }}</td>
                    <td class="text-center">{{ $acceptanceList->atp_rectification_date }}</td>
                    <td class="text-center">{{ $acceptanceList->atp_approved_date }}</td>
                    <td class="text-center">{{ $acceptanceList->atp_status }}</td>
                    <td class="text-center">{{ $acceptanceList->atp_file_naming }}</td>
                    <td class="text-center">{{ $acceptanceList->url_atp_ppm }}</td>
                    <td class="text-center">{{ $acceptanceList->aging_oa_to_atp_submit }}</td>
                    <td class="text-center">{{ $acceptanceList->total_aging_atp }}</td>
                    <td class="text-center">{{ $acceptanceList->remark }}</td>
                    <td class="text-center">{{ $acceptanceList->last_update }}</td>
                </tr>
                <tr id="details-{{ $acceptanceList->id_implementasi }}" class="collapse no-border-collapse">
                    <td colspan="21">
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA:</strong> {{ $acceptanceList->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area:</strong> {{ $acceptanceList->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone:</strong> {{ $acceptanceList->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group:</strong> {{ $acceptanceList->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW:</strong> {{ $acceptanceList->sow }}
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
    {{ $dataAcceptanceList->appends(request()->except('page'))->links() }}
 </div>