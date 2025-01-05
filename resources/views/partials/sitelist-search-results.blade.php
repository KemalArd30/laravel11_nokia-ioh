<!-- Form for Bulk Delete -->
<form id="bulk-delete-form" action="{{ route('sitelist.bulk-delete') }}" method="POST">
    @csrf
    @method('POST')

    <div class="table-responsive">
        <table class="table table-nowrap">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center">No</th>
                    <th class="text-center">Project Year</th>
                    <th class="text-center">Region</th>
                    <th class="text-center">System Key</th>
                    <th class="text-center">SMP-ID</th>
                    <th class="text-center">Site ID</th>
                    <th class="text-center">Site Name</th>
                    <th class="text-center">Status Site</th>
                    <th class="text-center">Phase Name</th>
                    <th class="text-center">SOW Detail</th>
                    <th class="text-center">Remark</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">Last Update</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataSitelist as $sitelist)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="ids[]" value="{{ $sitelist->id_sitelist }}" class="row-checkbox">
                        </td>
                        <td class="text-center">{{ ($dataSitelist->currentPage() - 1) * $dataSitelist->perPage() + $loop->iteration }}</td>
                        <td class="text-center">
                            {{ $sitelist->project_year }}
                            <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $sitelist->id_sitelist }}" aria-expanded="false" aria-controls="details-{{ $sitelist->id_sitelist }}">
                                <i class="fa-solid fa-caret-down"></i>
                            </button>
                        </td>
                        <td class="text-center">{{ $sitelist->regional }}</td>
                        <td class="text-center">{{ $sitelist->system_key }}</td>
                        <td class="text-center">{{ $sitelist->smp_id }}</td>
                        <td class="text-center">{{ $sitelist->site_id }}</td>
                        <td class="text-center">{{ $sitelist->site_name }}</td>
                        <td class="text-center">{{ $sitelist->status_site }}</td>
                        <td class="text-center">{{ $sitelist->phase_name }}</td>
                        <td class="text-center">{{ $sitelist->sow_detail }}</td>
                        <td class="text-center">{{ $sitelist->remark }}</td>
                        <td class="text-center">{{ $sitelist->created_at }}</td>
                        <td class="text-center">{{ $sitelist->last_update }}</td>
                        <td class="text-center">
                            <a href="{{ url('sitelist/'.$sitelist->id_sitelist.'/edit') }}" style="margin-right: 10px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            <!-- Delete confirmation modal -->
                            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $sitelist->id_sitelist }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
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
</form>
