@extends('layouts.app')

@section('title', 'Site List')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<link href="{{ asset('css/sub-content/sub-content.css') }}" rel="stylesheet">
<link href="{{ asset('css/table/table.css') }}" rel="stylesheet">
<script src="{{ asset('js/table-siteList.js') }}"></script>
<script src="{{ asset('js/FilterResetButton.js') }}"></script>
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
  var searchRoute = "{{ route('sitelist.index') }}";
</script>
<script src="{{ asset('js/sitelist-liveSearch.js') }}"></script> --}}

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
          @if (Auth::check() && Auth::user()->role === 'admin')
            <li><a href="#" id="select-all-link" class="select-all"><i class="fa-solid fa-square-check"></i> Select All</a></li>
            <li><a href="#" id="deselect-all-link" class="deselect-all"><i class="fa-solid fa-x"></i> Deselect</a></li>
            <li><a href="#" id="delete-selected-link" class="delete-selected"><i class="fa-solid fa-trash-alt"></i> Delete Selected</a></li>
          @endif
            <li><a href="#" id="refresh-link" data-refresh-url="{{ route('sitelist.data') }}"><i class="fa-solid fa-sync-alt"></i>Refresh</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#searchModal" class="filter"><i class="fa-solid fa-filter"></i> Filter</a></li>
            <li><a href="{{ route('sitelist.export') }}" class="export-data"><i class="fa-solid fa-file-export"></i> Export Data</a></li>
        </ul>
    </div>

    {{-- <!-- Search Bar -->
    <div class="search-bar mb-0 mt-0">
      <input type="text" id="search-input" placeholder="Everything Search ....">
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
          data-fixed-number="6"
          data-search-highlight="true"
          data-loading-font-size="16px">
          <thead class="wrap-text">
            <tr>
              @if (Auth::check() && Auth::user()->role === 'admin')
              <th></th>
              @endif
              <th class="text-center" data-field="no" data-sortable="true">No</th>
              <th class="text-center" data-field="project_year" data-sortable="true">Project Year</th>
              <th class="text-center" data-field="regional" data-sortable="true">Region</th>
              <th class="text-center" data-field="site_id" data-sortable="true">Site ID</th>
              <th class="text-center" data-field="site_name" data-sortable="true">Site Name</th>
              <th class="text-center" data-field="system_key" data-sortable="true">System Key</th>
              <th class="text-center" data-field="smp_id" data-sortable="true">SMP-ID</th>
              <th class="text-center" data-field="status_site" data-sortable="true">Status Site</th>
              <th class="text-center" data-field="phase_name" data-sortable="true">Phase Name</th>
              <th class="text-center" data-field="sow_detail" data-sortable="true">SOW Detail</th>
              <th class="text-center" data-field="remark" data-sortable="true">Remark</th>
              <th class="text-center" data-field="created_at" data-sortable="true">Created At</th>
              <th class="text-center" data-field="last_update" data-sortable="true">Last Update</th>
              @if (Auth::check() && Auth::user()->role === 'admin')
              <th class="text-center">Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse ($dataSitelist as $sitelist)
                <tr>
                  @if (Auth::check() && Auth::user()->role === 'admin')
                    <td class="text-center">
                        <input type="checkbox" name="ids[]" value="{{ $sitelist->id_sitelist }}" class="row-checkbox">
                    </td>
                    @endif
                    <td class="text-center">{{ ($dataSitelist->currentPage() - 1) * $dataSitelist->perPage() + $loop->iteration }}</td>
                    <td class="text-center">
                        {{ $sitelist->project_year }}
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $sitelist->id_sitelist }}" aria-expanded="false" aria-controls="details-{{ $sitelist->id_sitelist }}">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </td>
                    <td class="text-center">{{ $sitelist->regional }}</td>
                    <td class="text-center">{{ $sitelist->site_id }}</td>
                    <td class="text-center">{{ $sitelist->site_name }}</td>
                    <td class="text-center">{{ $sitelist->system_key }}</td>
                    <td class="text-center">{{ $sitelist->smp_id }}</td>
                    <td class="text-center">{{ $sitelist->status_site }}</td>
                    <td class="text-center">{{ $sitelist->phase_name }}</td>
                    <td class="text-center">{{ $sitelist->sow_detail }}</td>
                    <td class="text-center">{{ $sitelist->remark }}</td>
                    <td class="text-center">{{ $sitelist->created_at }}</td>
                    <td class="text-center">{{ $sitelist->last_update }}</td>
                    @if (Auth::check() && Auth::user()->role === 'admin')
                    <td class="text-center">
                        <a href="{{ url('sitelist/'.$sitelist->id_sitelist.'/edit') }}" style="margin-right: 10px;">
                            <i class="fa fa-edit"></i>
                        </a>
                        <!-- Delete confirmation modal -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $sitelist->id_sitelist }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                    @endif
                </tr>
                <tr id="details-{{ $sitelist->id_sitelist }}" class="collapse no-border-collapse">
                    <td colspan="11"> <!-- Sesuaikan jumlah kolom jika perlu -->
                        <div class="text-start" style="padding:5px;">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <strong>COA :</strong> {{ $sitelist->coa }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Area :</strong> {{ $sitelist->area }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Zone :</strong> {{ $sitelist->zone }}
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <strong>Phase Group :</strong> {{ $sitelist->phase_group }}
                                </div>
                                <div class="col-lg-4 col-md-6 wrap-text">
                                    <strong>SOW :</strong> {{ $sitelist->sow }}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="20" class="text-center">Tidak ada data yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<!-- Menampilkan pagination -->
<div class="p-2">
    {{ $dataSitelist->appends(request()->except('page'))->links() }}
</div>

    {{-- <!-- Container untuk hasil tabel -->
    <div id="sitelist-table-container">
      @include('partials.sitelist-search-results', ['dataSitelist' => $dataSitelist])
    </div> --}}
    
    <!-- Modal Filter -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-custom">
              <h5 class="modal-title" id="searchModalLabel">Filter Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="pb-3" action="{{ url('sitelist') }}" method="get">
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
                    <label for="coa" class="col-sm-2 col-form-label-sm">COA</label>
                    <div class="col-sm-4">
                      <input type="search" class="form-control form-control-sm" name="coa" id="coa" value="{{ Request::get('coa') }}" aria-label="coa">
                    </div>
                    <label for="zone" class="col-sm-1 ms-auto col-form-label-sm">Zone</label>
                    <div class="col-sm-4 ms-auto">
                      <input type="search" class="form-control form-control-sm" name="zone" id="zone" value="{{ Request::get('zone') }}" aria-label="zone">
                    </div>
                  </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="region" class="col-sm-2 col-form-label-sm">Region</label>
                    <div class="col-sm-4">
                      <input type="search" class="form-control form-control-sm" name="region" id="region" value="{{ Request::get('regional') }}" aria-label="Region">
                    </div>
                    <label for="area" class="col-sm-1 ms-auto col-form-label-sm">Area</label>
                    <div class="col-sm-4 ms-auto">
                      <input type="search" class="form-control form-control-sm" name="area" id="area" value="{{ Request::get('area') }}" aria-label="Area">
                    </div>
                  </div>
                <div class="mb-3 row d-flex align-items-center">
                    <label for="systemKey" class="col-sm-2 col-form-label-sm">System Key</label>
                    <div class="col-sm-4">
                      <input type="search" class="form-control form-control-sm" name="systemKey" id="systemKey" value="{{ Request::get('system_key') }}" aria-label="systemKey">
                    </div>
                    <label for="smpID" class="col-sm-1 ms-auto col-form-label-sm">SMP-ID</label>
                    <div class="col-sm-4 ms-auto">
                      <input type="search" class="form-control form-control-sm" name="smpID" id="smpID" value="{{ Request::get('smp_id') }}" aria-label="smpID">
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
                <div class="mb-3 row">
                  <label for="phaseName" class="col-sm-2 col-form-label-sm">Phase Name</label>
                  <div class="col-sm-10">
                    <input type="search" class="form-control form-control-sm" name="phaseName" value="{{ Request::get('phase_name') }}" aria-label="phaseName">
                  </div>
                </div>
                <div class="mb-3 row">
                    <label for="sow" class="col-sm-2 col-form-label-sm">SOW</label>
                    <div class="col-sm-10">
                      <input type="search" class="form-control form-control-sm" name="sow" value="{{ Request::get('sow') }}" aria-label="sow">
                </div>
                </div>
                <div class="mb-3 row">
                    <label for="sowDetail" class="col-sm-2 col-form-label-sm">SOW Detail</label>
                    <div class="col-sm-10">
                      <input type="search" class="form-control form-control-sm" name="sowDetail" value="{{ Request::get('sow_detail') }}" aria-label="sowDetail">
                </div>
            </div>
              </div>
            <div class="modal-footer mb-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning btn-sm" id="resetButton" data-url="{{ url('sitelist') }}">Reset</button>
                <button class="btn btn-primary btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass sm"></i> Search</button>
            </div>
            </form>
          </div>
        </div>
      </div>

    <!-- Modal Delete per item Confirmation -->
    @foreach ($dataSitelist as $sitelist)
            <div class="modal fade" id="deleteModal-{{ $sitelist->id_sitelist }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $sitelist->id_sitelist }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $sitelist->id_sitelist }}">Konfirmasi Penghapusan Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('sitelist.destroy', $sitelist->id_sitelist) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
</div>

@endsection