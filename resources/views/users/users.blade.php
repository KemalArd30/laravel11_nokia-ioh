@extends('layouts.app')

@section('title', 'List Users')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<link href="{{ asset('css/sub-content/sub-content.css') }}" rel="stylesheet">
<script src="{{ asset('js/table-UserList.js') }}"></script>
<link href="{{ asset('css/table/table.css') }}" rel="stylesheet">
<script src="{{ asset('js/FilterResetButton.js') }}"></script>
<!-- Link jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  var searchRoute = "{{ route('users.index') }}";
</script>

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
            <li><a href="#" class="export-data"><i class="fa-solid fa-file-export"></i> Export Data</a></li>
        </ul>
    </div>

    <!-- Form for Bulk Delete -->
    <form id="bulk-delete-form" action="{{ route('users.bulk-delete') }}" method="POST">
        @csrf
    </form>

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
            data-fixed-columns="false"
            data-fixed-number="2"
            data-search-highlight="true"
            data-loading-font-size="16px">
            <thead class="wrap-text">
              <tr>
              <th></th>
              <th class="text-center" data-field="no" data-sortable="true">No</th>
              <th class="text-center" data-field="name" data-sortable="true">Name</th>
              <th class="text-center" data-field="email" data-sortable="true">Email</th>
              <th class="text-center" data-field="region" data-sortable="true">Region</th>
              <th class="text-center" data-field="role" data-sortable="true">Role</th>
              <th class="text-center" data-field="created_at" data-sortable="true">Created At</th>
              <th class="text-center" data-field="updated_at" data-sortable="true">Updated At</th>
              <th class="text-center" data-field="action" data-sortable="true">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            @forelse ($users as $user)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="ids[]" value="{{ $user->id }}" class="row-checkbox">
                    </td>
                    <td class="text-center">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">{{ $user->regional }}</td>
                    <td class="text-center">{{ $user->role }}</td>
                    <td class="text-center">{{ $user->created_at }}</td>
                    <td class="text-center">{{ $user->updated_at }}</td>
                    <td class="text-center">
                        <a href="{{ url('users/'.$user->id.'/edit') }}" style="margin-right: 10px;">
                            <i class="fa fa-edit"></i>
                        </a>
                        <!-- Delete confirmation modal -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $user->id }}">
                            <i class="fa fa-trash"></i>
                        </a>
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
    {{ $users->appends(request()->except('page'))->links() }}
 </div>

 <!-- Modal Filter -->
 <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title" id="searchModalLabel">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="pb-3" action="{{ url('users') }}" method="get">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label-sm">Name</label>
                        <div class="col-sm-10">
                            <input type="search" class="form-control form-control-sm" name="name" value="{{ Request::get('name') }}" aria-label="Name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label-sm">Email</label>
                        <div class="col-sm-10">
                            <input type="search" class="form-control form-control-sm" name="email" value="{{ Request::get('email') }}" aria-label="Email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="regional" class="col-sm-2 col-form-label-sm">region</label>
                        <div class="col-sm-10">
                            <input type="search" class="form-control form-control-sm" name="regional" value="{{ Request::get('regional') }}" aria-label="Region">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="role" class="col-sm-2 col-form-label-sm">Role</label>
                        <div class="col-sm-10">
                            <input type="search" class="form-control form-control-sm" name="role" value="{{ Request::get('role') }}" aria-label="Role">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning btn-sm" id="resetButton" data-url="{{ url('users') }}">Reset</button>
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Delete per item Confirmation -->
@foreach ($users as $user)
<div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $user->id }}">Konfirmasi Penghapusan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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