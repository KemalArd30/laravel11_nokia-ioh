@extends('layouts.app')

@section('title', 'Region List')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<link href="{{ asset('css/sub-content/sub-content.css') }}" rel="stylesheet">
<link href="{{ asset('css/table/table.css') }}" rel="stylesheet">
<script src="{{ asset('js/table-regionList.js') }}"></script>
<script src="{{ asset('js/FilterResetButton.js') }}"></script>
<!-- Link jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  var searchRoute = "{{ route('region.index') }}";
</script>
<script src="{{ asset('js/region-liveSearch.js') }}"></script>

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
            <li><a href="#" id="select-all-link" class="select-all"><i class="fa-solid fa-square-check"></i> Select All</a></li>
            <li><a href="#" id="deselect-all-link" class="deselect-all"><i class="fa-solid fa-x"></i> Deselect</a></li>
            <li><a href="#" id="delete-selected-link" class="delete-selected"><i class="fa-solid fa-trash-alt"></i> Delete Selected</a></li>
            <li><a href="#" class="refresh"><i class="fa-solid fa-sync-alt"></i> Refresh</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#searchModal" class="filter"><i class="fa-solid fa-filter"></i> Filter</a></li>
            <li><a href="{{ route('regionlist.export') }}" class="export-data"><i class="fa-solid fa-file-export"></i> Export Data</a></li>
        </ul>
    </div>

    <!-- Search Bar -->
    <div class="search-bar mb-0 mt-0">
        <input type="text" id="search-input" placeholder="Everything Search ....">
      </div>

      <!-- Container untuk hasil tabel -->
      <div id="region-table-container">
        @include('partials.region-search-results', ['regions' => $regions])
      </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title" id="searchModalLabel">Filter Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="pb-3" action="{{ url('region') }}" method="get">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="coa" class="col-sm-2 col-form-label-sm">COA</label>
                            <div class="col-sm-10">
                                <input type="search" class="form-control form-control-sm" name="coa" value="{{ Request::get('coa') }}" aria-label="COA">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="project" class="col-sm-2 col-form-label-sm">Project</label>
                            <div class="col-sm-10">
                                <input type="search" class="form-control form-control-sm" name="project" value="{{ Request::get('project') }}" aria-label="Project">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="region" class="col-sm-2 col-form-label-sm">Region</label>
                            <div class="col-sm-10">
                                <input type="search" class="form-control form-control-sm" name="region" value="{{ Request::get('regional') }}" aria-label="Region">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-warning btn-sm" id="resetButton" data-url="{{ url('region') }}">Reset</button>
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete per item Confirmation -->
    @foreach ($regions as $region)
        <div class="modal fade" id="deleteModal-{{ $region->coa }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $region->coa }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel-{{ $region->coa }}">Konfirmasi Penghapusan Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('region.destroy', $region->coa) }}" method="POST">
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