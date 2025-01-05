@extends('layouts.app')

@section('title', 'TSS List')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<link href="{{ asset('css/sub-content/sub-content.css') }}" rel="stylesheet">
<link href="{{ asset('css/table/table.css') }}" rel="stylesheet">
<script src="{{ asset('js/FilterResetButton.js') }}"></script>

<!-- Link Table -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/editable/bootstrap-table-editable.min.js"></script>

{{-- <script>
  var searchRoute = "{{ route('tss.index') }}";
</script>
<script src="{{ asset('js/tss-liveSearch.js') }}"></script> --}}


<div class="bg-body rounded shadow-sm mt-2 p-0">

    <!-- Display Flash Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            {{ session('success') }}
            <button type="button" class=" fade show btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="sub-content pb-0 pt-0">
        <ul class="item-content">
            <li><a href="#" id="refresh-link" data-refresh-url=""><i class="fa-solid fa-sync-alt"></i>Refresh</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#searchModal" class="filter"><i class="fa-solid fa-filter"></i> Filter</a></li>
            <li><a href="{{ route('tss.export') }}" class="export-data"><i class="fa-solid fa-file-export"></i> Export Data</a></li>
        </ul>
    </div>

      <div class="table-responsive">
        <table 
            id="table" 
            class="table table-bordered table-hover"
            data-toggle="table"
            data-show-columns-toggle-all="true"
            data-sort-name="last_update"
            data-sort-order="desc"
            data-search="true"
            data-show-columns-search="true"
            data-show-columns="true"
            data-fixed-columns="true"
            data-fixed-number="3"
            data-search-highlight="true"
            data-loading-font-size="16px">
            <thead class="wrap-text">
              <tr>
              <th class="text-center" data-field="no" data-sortable="true">No</th>
              <th class="text-center" data-field="site_id" data-sortable="true">Site ID</th>
              <th class="text-center" data-field="site_name" data-sortable="true">Site Name</th>
              <th class="text-center" data-field="project_year" data-sortable="true">Project Year</th>
              <th class="text-center" data-field="regional" data-sortable="true">Region</th>
              <th class="text-center" data-field="smp_id" data-sortable="true">SMP-ID</th>
              <th class="text-center" data-field="status_site" data-sortable="true">Status TSS</th>
              <th class="text-center" data-field="phase_name" data-sortable="true">Phase Name</th>
              <th class="text-center" data-field="scm_assigned_to_fst" data-sortable="true">SCM Assigned to FST</th>
              <th class="text-center" data-field="fill_tss_checklist_complete" data-sortable="true">Fill TSS Checklist Complete</th>
              <th class="text-center" data-field="review_by_scm" data-sortable="true">Review by SCM</th>
              <th class="text-center" data-field="review_by_pe" data-sortable="true">Review by PE</th>
              <th class="text-center" data-field="tssr_done" data-sortable="true">TSS Approved Date</th>
              <th class="text-center" data-field="aging_survey_to_tss_submit" data-sortable="true">Aging Survey - TSS Submit</th>
              <th class="text-center" data-field="total_aging_tss" data-sortable="true">Total Aging TSS</th>
              <th class="text-center" data-field="tssr_file_naming" data-sortable="true">TSSR File Naming</th>
              <th class="text-center" data-field="upload_date_tssr_ppm" data-sortable="true">Upload Date TSSR PPM</th>
              <th class="text-center" data-field="url_tssr_ppm" data-sortable="true">Url TSSR PPM</th>
              <th class="text-center" data-field="remark" data-sortable="true">Remark</th>
              <th class="text-center" data-field="last_update" data-sortable="true">Last Update</th>
              
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
                        <a href="{{ route('tss.edit', ['id_tss' => $tsslist->id_tss]) }}" style="text-decoration: none; font-size: 12px;">
                          {{ $tsslist->site_id }}
                        </a>
                    
                        <!-- Tombol collapse -->
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $tsslist->id_tss }}" aria-expanded="false" aria-controls="details-{{ $tsslist->id_tss }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                      <td class="text-center">{{ $tsslist->site_name }}</td>
                      <td class="text-center">{{ $tsslist->project_year }}</td>
                      <td class="text-center">{{ $tsslist->regional }}</td>
                      <td class="text-center">{{ $tsslist->smp_id }}</td>
                      <td class="text-center">{{ $tsslist->status_site }}</td>
                      <td class="text-center">{{ $tsslist->phase_name }}</td>
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
    
    <!-- Modal Filter -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-custom">
              <h5 class="modal-title" id="searchModalLabel">Filter Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="pb-3" action="{{ url('tss') }}" method="get">
              <div class="modal-body">
                <div class="mb-3 row">
                  <label for="projectYear" class="col-sm-2 col-form-label-sm">Project Year</label>
                  <div class="col-sm-10">
                    <input type="search" class="form-control form-control-sm" name="projectYear" value="{{ Request::get('project_year') }}" aria-label="Project Year">
                  </div>
                </div>
                <div class="mb-3 row">
                    <label for="statusSite" class="col-sm-2 col-form-label-sm">Status Site</label>
                    <div class="col-sm-10">
                      <input type="search" class="form-control form-control-sm" name="statusSite" value="{{ Request::get('status_site') }}" aria-label="Status Site">
                    </div>
                  </div>
                <div class="mb-3 row d-flex align-items-center">
                  <label for="region" class="col-sm-2 col-form-label-sm">Region</label>
                  <div class="col-sm-4">
                    <input type="search" class="form-control form-control-sm" name="region" id="region" value="{{ Request::get('regional') }}" aria-label="Region">
                  </div>
                    <label for="zone" class="col-sm-1 ms-auto col-form-label-sm">Zone</label>
                    <div class="col-sm-4 ms-auto">
                      <input type="search" class="form-control form-control-sm" name="zone" id="zone" value="{{ Request::get('zone') }}" aria-label="zone">
                    </div>
                  </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="area" class="col-sm-2 col-form-label-sm">Area</label>
                    <div class="col-sm-4">
                      <input type="search" class="form-control form-control-sm" name="area" id="area" value="{{ Request::get('area') }}" aria-label="Area">
                    </div>
                    <label for="systemKey" class="col-sm-1 ms-auto col-form-label-sm">System Key</label>
                    <div class="col-sm-4 ms-auto">
                      <input type="search" class="form-control form-control-sm" name="systemKey" id="systemKey" value="{{ Request::get('system_key') }}" aria-label="systemKey">
                    </div>
                  </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="siteID" class="col-sm-2 col-form-label-sm">Site ID</label>
                    <div class="col-sm-4">
                      <input type="search" class="form-control form-control-sm" name="siteID" id="siteID" value="{{ Request::get('site_id') }}" aria-label="siteID">
                    </div>
                    <label for="siteName" class="col-sm-1 ms-auto col-form-label-sm">Site Name</label>
                    <div class="col-sm-4 ms-auto">
                      <input type="search" class="form-control form-control-sm" name="siteName" id="siteName" value="{{ Request::get('site_name') }}" aria-label="siteName">
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                  <label for="smpID" class="col-sm-2 col-form-label-sm">SMP-ID</label>
                  <div class="col-sm-4">
                    <input type="search" class="form-control form-control-sm" name="smpID" id="smpID" value="{{ Request::get('smp_id') }}" aria-label="smpID">
                  </div>
                  <label for="moduleID" class="col-sm-1 ms-auto col-form-label-sm">Module ID</label>
                  <div class="col-sm-4 ms-auto">
                    <input type="search" class="form-control form-control-sm" name="moduleID" id="moduleID" value="{{ Request::get('module_id') }}" aria-label="moduleID">
                  </div>
              </div>
                <div class="mb-3 row d-flex align-items-center">
                  <label for="scmAssignedToFST" class="col-sm-2 col-form-label-sm">SCM Assigned to FST</label>
                  <div class="col-sm-4">
                    <input type="date" class="form-control form-control-sm" name="scmAssignedToFST" id="scmAssignedToFST" value="{{ Request::get('scm_assigned_to_fst') }}" aria-label="scmAssignedToFST">
                  </div>
                  <label for="fillTssChecklistComplete" class="col-sm-1 ms-auto col-form-label-sm">Fill TSS Checklist Complete</label>
                  <div class="col-sm-4 ms-auto">
                    <input type="date" class="form-control form-control-sm" name="fillTssChecklistComplete" id="fillTssChecklistComplete" value="{{ Request::get('fill_tss_checklist_complete') }}" aria-label="fillTssChecklistComplete">
                  </div>
              </div>
              <div class="mb-3 row d-flex align-items-center">
                <label for="reviewBySCM" class="col-sm-2 col-form-label-sm">Review by SCM</label>
                <div class="col-sm-4">
                  <input type="date" class="form-control form-control-sm" name="reviewBySCM" id="reviewBySCM" value="{{ Request::get('review_by_scm') }}" aria-label="reviewBySCM">
                </div>
                <label for="reviewByPE" class="col-sm-1 ms-auto col-form-label-sm">Review by PE</label>
                <div class="col-sm-4 ms-auto">
                  <input type="date" class="form-control form-control-sm" name="reviewByPE" id="reviewByPE" value="{{ Request::get('fill_tss_checklist_complete') }}" aria-label="reviewByPE">
                </div>
            </div>
                <div class="mb-3 row">
                  <label for="tssApprovedDate" class="col-sm-2 col-form-label-sm">TSS Approved Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control form-control-sm" name="tssApprovedDate" value="{{ Request::get('tssr_done') }}" aria-label="tssApprovedDate">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="uploadDateTssrPpm" class="col-sm-2 col-form-label-sm">Upload TSSR PPM</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control form-control-sm" name="uploadDateTssrPpm" value="{{ Request::get('upload_date_tssr_ppm') }}" aria-label="uploadDateTssrPpm">
                  </div>
                </div>
            </div>
            <div class="modal-footer mb-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning btn-sm" id="resetButton" data-url="{{ url('tss') }}">Reset</button>
                <button class="btn btn-primary btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass sm"></i> Search</button>
            </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection