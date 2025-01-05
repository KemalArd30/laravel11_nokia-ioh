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
                <th class="text-center">Aging Survey - TSS Submit</th>
                <th class="text-center">Total Aging TSS</th>
                <th class="text-center">TSSR File Naming</th>
                <th class="text-center">Upload Date TSSR PPM</th>
                <th class="text-center">Url TSSR PPM</th>
                <th class="text-center">Remark</th>
                <th class="text-center">Last Update</th>
            </tr>
        </thead>
        <tbody>
          <!-- Tempat untuk hasil pencarian -->
            <?php $i = 1; ?>
            @forelse ($dataTssList as $tsslist)
                <tr>
                    <td class="text-center">{{ ($dataTssList->currentPage() - 1) * $dataTssList->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                      <!-- Hyperlink site_id menuju halaman edit -->
                      <a href="{{ url('tss/'.$tsslist->id_tss.'/edit') }}" style="text-decoration: none; font-size: 12px;">
                        {{ $tsslist->site_id }}
                    </a>
                  
                      <!-- Tombol collapse -->
                      <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $tsslist->id_tss }}" aria-expanded="false" aria-controls="details-{{ $tsslist->id_tss }}">
                          <i class="fa-solid fa-caret-down"></i>
                      </button>
                  </td>
                    <td class="text-center">{{ $tsslist->site_name }}</td>
                    <td class="text-center">{{ $tsslist->regional }}</td>
                    <td class="text-center">{{ $tsslist->project_year }}</td>
                    <td class="text-center">{{ $tsslist->phase_name }}</td>
                    <td class="text-center">{{ $tsslist->smp_id }}</td>
                    <td class="text-center">{{ $tsslist->module_id }}</td>
                    <td class="text-center">{{ $tsslist->status_site }}</td>
                    <td class="text-center">{{ $tsslist->scm_assigned_to_fst }}</td>
                    <td class="text-center">{{ $tsslist->fill_tss_checklist_complete }}</td>
                    <td class="text-center">{{ $tsslist->review_by_scm }}</td>
                    <td class="text-center">{{ $tsslist->review_by_pe }}</td>
                    <td class="text-center">{{ $tsslist->tssr_done }}</td>
                    <td class="text-center">{{ $tsslist->aging_survey_to_tss_submit }}</td>
                    <td class="text-center">{{ $tsslist->total_aging_tss }}</td>
                    <td class="text-center">{{ $tsslist->tssr_file_naming }}</td>
                    <td class="text-center">{{ $tsslist->upload_date_tssr_ppm }}</td>
                    <td class="text-center">{{ $tsslist->url_tssr_ppm }}</td>
                    <td class="text-center">{{ $tsslist->remark }}</td>
                    <td class="text-center">{{ $tsslist->last_update }}</td>
                </tr>
                <tr id="details-{{ $tsslist->id_tss }}" class="collapse no-border-collapse">
                    <td colspan="11"> <!-- Sesuaikan jumlah kolom jika perlu -->
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>System Key :</strong> {{ $tsslist->system_key }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA :</strong> {{ $tsslist->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area :</strong> {{ $tsslist->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone :</strong> {{ $tsslist->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group :</strong> {{ $tsslist->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW :</strong> {{ $tsslist->sow }}
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
{{ $dataTssList->appends(request()->except('page'))->links() }}
</div>