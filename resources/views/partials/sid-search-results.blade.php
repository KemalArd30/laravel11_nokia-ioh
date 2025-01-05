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
                <th class="text-center">Module ID</th>
                <th class="text-center">Status TSS</th>
                <th class="text-center">SCM Assigned to FST</th>
                <th class="text-center">Fill TSS Checklist Complete</th>
                <th class="text-center">Review By SCM</th>
                <th class="text-center">Review By PE</th>
                <th class="text-center">TSS Approved Date</th>
                <th class="text-center">SID File Naming</th>
                <th class="text-center">Upload Date SID PPM</th>
                <th class="text-center">Url SID PPM</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
          <!-- Tempat untuk hasil pencarian -->
            <?php $i = 1; ?>
            @forelse ($dataSidList as $sidlist)
                <tr>
                    <td class="text-center">{{ ($dataSidList->currentPage() - 1) * $dataSidList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                      <!-- Hyperlink site_id menuju halaman edit -->
                      <a href="{{ url('sid/'.$sidlist->id_tss.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                        {{ $sidlist->site_id }}
                    </a>
                  
                      <!-- Tombol collapse -->
                      <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $sidlist->id_tss }}" aria-expanded="false" aria-controls="details-{{ $sidlist->id_tss }}">
                          <i class="fa-solid fa-caret-down"></i>
                      </button>
                  </td>
                    <td class="text-center">{{ $sidlist->site_name }}</td>
                    <td class="text-center">{{ $sidlist->regional }}</td>
                    <td class="text-center">{{ $sidlist->project_year }}</td>
                    <td class="text-center">{{ $sidlist->phase_name }}</td>
                    <td class="text-center">{{ $sidlist->smp_id }}</td>
                    <td class="text-center">{{ $sidlist->module_id }}</td>
                    <td class="text-center">{{ $sidlist->status_site }}</td>
                    <td class="text-center">{{ $sidlist->scm_assigned_to_fst }}</td>
                    <td class="text-center">{{ $sidlist->fill_tss_checklist_complete }}</td>
                    <td class="text-center">{{ $sidlist->review_by_scm }}</td>
                    <td class="text-center">{{ $sidlist->review_by_pe }}</td>
                    <td class="text-center">{{ $sidlist->tssr_done }}</td>
                    <td class="text-center">{{ $sidlist->sid_file_naming }}</td>
                    <td class="text-center">{{ $sidlist->upload_date_sid_ppm }}</td>
                    <td class="text-center">{{ $sidlist->url_sid_ppm }}</td>
                    <td class="text-center">{{ $sidlist->remark_sid }}</td>
                    <td class="text-center">{{ $sidlist->last_update_sid }}</td>
                </tr>
                <tr id="details-{{ $sidlist->id_tss }}" class="collapse no-border-collapse">
                    <td colspan="11"> <!-- Sesuaikan jumlah kolom jika perlu -->
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>System Key :</strong> {{ $sidlist->system_key }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA :</strong> {{ $sidlist->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area :</strong> {{ $sidlist->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone :</strong> {{ $sidlist->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group :</strong> {{ $sidlist->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW :</strong> {{ $sidlist->sow }}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $i++; ?>
            @empty
                <tr>
                    <td colspan="19" class="text-center">No Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="p-2">
    {{ $dataSidList->appends(request()->except('page'))->links() }}
</div>