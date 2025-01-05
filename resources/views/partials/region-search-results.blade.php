<!-- Form for Bulk Delete -->
<form id="bulk-delete-form" action="{{ route('regions.bulk-delete') }}" method="POST">
    @csrf
    @method('DELETE')

<div class="table-responsive">
    <table class="table table-nowrap">
        <thead>
            <tr>
                <th></th>
                <th class="text-center">COA</th>
                <th class="text-center">Project</th>
                <th class="text-center">Region</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Last Update</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($regions as $region)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="ids[]" value="{{ $region->coa }}" class="row-checkbox">
                    </td>
                    <td class="text-center">{{ $region->coa }}</td>
                    <td class="text-center">{{ $region->project }}</td>
                    <td class="text-center">{{ $region->regional }}</td>
                    <td class="text-center">{{ $region->created_at }}</td>
                    <td class="text-center">{{ $region->last_update }}</td>
                    <td class="text-center">
                        <a href="{{ url('region/'.$region->coa.'/edit') }}" style="margin-right: 10px;">
                            <i class="fa fa-edit"></i>
                        </a>
                        <!-- Delete confirmation modal -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $region->coa }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data region yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="p-2">
    {{ $regions->appends(request()->except('page'))->links() }}
    </div>
</form>