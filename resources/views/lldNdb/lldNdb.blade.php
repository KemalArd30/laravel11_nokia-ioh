@extends('layouts.app')

@section('title', 'LLD/NDB')

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
  var searchRoute = "{{ route('lldNdb.index') }}";
</script>
<script src="{{ asset('js/lldNdb-liveSearch.js') }}"></script> --}}


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
            <li><a href="{{ route('acceptance.export') }}" class="export-data"><i class="fa-solid fa-file-export"></i> Export Data</a></li>
        </ul>
    </div>

        {{-- <!-- Search Bar -->
        <div class="search-bar mb-0 mt-0">
          <input type="text" id="search-input" placeholder="Everything Search ....">
        </div>

        <!-- Container untuk hasil tabel -->
        <div id="lldNdb-table-container">
          @include('partials.lldNdb-search-results', ['dataLldNdbList' => $dataLldNdbList])
        </div> --}}

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
                <th class="text-center" data-field="system_key" data-sortable="true">System Key</th>
                <th class="text-center" data-field="smp_id" data-sortable="true">SMP-ID</th>
                <th class="text-center" data-field="status_site" data-sortable="true">Status Site</th>
                <th class="text-center" data-field="phase_name" data-sortable="true">Phase Name</th>
                <th class="text-center" data-field="oa_date" data-sortable="true">OA Date</th>
                <th class="text-center" data-field="status_oa" data-sortable="true">Status OA</th>
                <th class="text-center" data-field="lld_file_naming" data-sortable="true">LLD/NDB File Naming</th>
                <th class="text-center" data-field="upload_date_lld_ppm" data-sortable="true">Upload Date LLD/NDB PPM</th>
                <th class="text-center" data-field="url_lld_ppm" data-sortable="true">URL LLD/NDB PPM</th>
                <th class="text-center" data-field="remark" data-sortable="true">Remark</th>
                <th class="text-center" data-field="last_update" data-sortable="true">Last Update</th>
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
                      <td class="text-center">{{ $lldNdbList->project_year }}</td>
                      <td class="text-center">{{ $lldNdbList->regional }}</td>
                      <td class="text-center">{{ $lldNdbList->system_key }}</td>
                      <td class="text-center">{{ $lldNdbList->smp_id }}</td>
                      <td class="text-center">{{ $lldNdbList->status_site }}</td>
                      <td class="text-center">{{ $lldNdbList->phase_name }}</td>
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
    
    <!-- Modal Filter -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-custom">
              <h5 class="modal-title" id="searchModalLabel">Filter Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="pb-3" action="{{ url('lldNdb') }}" method="get">
              <div class="modal-body">
                <div class="mb-3 row">
                  <label for="project_year" class="col-sm-2 col-form-label-sm">Project Year</label>
                  <div class="col-sm-10">
                    <input type="search" class="form-control form-control-sm" name="project_year" value="{{ Request::get('project_year') }}" aria-label="project_year">
                  </div>
                </div>
                <div class="mb-3 row">
                    <label for="status_site" class="col-sm-2 col-form-label-sm">Status Site</label>
                    <div class="col-sm-10">
                      <select class="form-select form-select-sm" name="status_site" id="status_site">
                        <option value="">Choose Status...</option>
                        <option value="ACTIVE" {{ Request::get('status_site') == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                        <option value="INACTIVE" {{ Request::get('status_site') == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
                      </select>
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                  <label for="regional" class="col-sm-2 col-form-label-sm">Region</label>
                  <div class="col-sm-4">
                    <input type="search" class="form-control form-control-sm" name="regional" id="regional" value="{{ Request::get('regional') }}" aria-label="regional">
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
                    <label for="system_key" class="col-sm-1 ms-auto col-form-label-sm">System Key</label>
                    <div class="col-sm-4 ms-auto">
                      <input type="search" class="form-control form-control-sm" name="system_key" id="system_key" value="{{ Request::get('system_key') }}" aria-label="system_key">
                    </div>
                  </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="site_id" class="col-sm-2 col-form-label-sm">Site ID</label>
                    <div class="col-sm-4">
                      <input type="search" class="form-control form-control-sm" name="site_id" id="site_id" value="{{ Request::get('site_id') }}" aria-label="site_id">
                    </div>
                    <label for="site_name" class="col-sm-1 ms-auto col-form-label-sm">Site Name</label>
                    <div class="col-sm-4 ms-auto">
                      <input type="search" class="form-control form-control-sm" name="site_name" id="site_name" value="{{ Request::get('site_name') }}" aria-label="site_name">
                    </div>
                </div>
                <div class="mb-3 row d-flex align-items-center">
                  <label for="smp_id" class="col-sm-2 col-form-label-sm">SMP-ID</label>
                  <div class="col-sm-4">
                    <input type="search" class="form-control form-control-sm" name="smp_id" id="smp_id" value="{{ Request::get('smp_id') }}" aria-label="smp_id">
                  </div>
                  <label for="phase_name" class="col-sm-1 ms-auto col-form-label-sm">Phase Name</label>
                  <div class="col-sm-4 ms-auto">
                    <input type="search" class="form-control form-control-sm" name="phase_name" id="phase_name" value="{{ Request::get('phase_name') }}" aria-label="phase_name">
                  </div>
              </div>
                <div class="mb-3 row d-flex align-items-center">
                  <label for="oa_date" class="col-sm-2 col-form-label-sm">OA Date</label>
                  <div class="col-sm-4">
                  <input type="date" class="form-control form-control-sm" name="oa_date" id="oa_date" value="{{ Request::get('oa_date') }}" aria-label="oa_date">
                </div>
                <label for="status_oa" class="col-sm-1 ms-auto col-form-label-sm">Status OA</label>
                <div class="col-sm-4 ms-auto">
                    <select class="form-select form-select-sm" name="status_oa" id="status_oa">
                        <option value="">Choose Status...</option>
                        <option value="FOA" {{ Request::get('status_oa') == 'FOA' ? 'selected' : '' }}>FOA</option>
                        <option value="Partial OA" {{ Request::get('status_oa') == 'Partial OA' ? 'selected' : '' }}>Partial OA</option>
                    </select>
                </div>
              </div>
            <div class="mb-3 row">
              <label for="upload_date_lld_ppm" class="col-sm-2 col-form-label-sm">Upload Date LLD/NDB PPM</label>
              <div class="col-sm-10">
                <input type="date" class="form-control form-control-sm" name="upload_date_lld_ppm" value="{{ Request::get('upload_date_lld_ppm') }}" aria-label="upload_date_lld_ppm">
              </div>
            </div>
                <div class="mb-3 row">
                  <label for="remark" class="col-sm-2 col-form-label-sm">Remark</label>
                  <div class="col-sm-10">
                    <input type="search" class="form-control form-control-sm" name="remark" value="{{ Request::get('remark') }}" aria-label="remark">
                  </div>
                </div>
            </div>
            <div class="modal-footer mb-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning btn-sm" id="resetButton" data-url="{{ url('lldNdb') }}">Reset</button>
                <button class="btn btn-primary btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass sm"></i> Search</button>
            </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection