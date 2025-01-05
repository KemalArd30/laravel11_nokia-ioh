@extends('layouts.app')

@section('content')

<link href="{{ asset('css/main-content/content.css') }}" rel="stylesheet">
<form action="{{ route('filenaming.update', $dataFileNaming->id_sitelist) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="my-0 p-5 bg-body rounded shadow-sm mt-2">
        <div class="fs-2 mb-5 row">Edit Naming</div>

        <div class="mb-3 row">
            <label for="siteID" class="col-sm-2 col-form-label">Site ID</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" placeholder="{{ $dataFileNaming->site_id }}" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="siteName" class="col-sm-2 col-form-label">Site Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" placeholder="{{ $dataFileNaming->site_name }}" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tssrFileNaming" class="col-sm-2 col-form-label">TSSR</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="tssrFileNaming" id="tssrFileNaming" value="{{ old('tssr_file_naming', $dataFileNaming->tssr_file_naming) }}">
                @error('tssrFileNaming')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="sidFileNaming" class="col-sm-2 col-form-label">SID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="sidFileNaming" id="sidFileNaming" value="{{ old('sid_file_naming', $dataFileNaming->sid_file_naming) }}">
                @error('sidFileNaming')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="netgearMosFileNaming" class="col-sm-2 col-form-label">NETGear</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="netgearMosFileNaming" id="netgearMosFileNaming" value="{{ old('netgear_mos_file_naming', $dataFileNaming->netgear_mos_file_naming) }}">
                @error('netgearMosFileNaming')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="lldFileNaming" class="col-sm-2 col-form-label">LLD</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="lldFileNaming" id="lldFileNaming" value="{{ old('lld_file_naming', $dataFileNaming->lld_file_naming) }}">
                @error('lldFileNaming')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="abdwFileNaming" class="col-sm-2 col-form-label">ABDW</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="abdwFileNaming" id="abdwFileNaming" value="{{ old('abdw_file_naming', $dataFileNaming->abdw_file_naming) }}">
                @error('abdwFileNaming')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="abdnFileNaming" class="col-sm-2 col-form-label">ABDN</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="abdnFileNaming" id="abdnFileNaming" value="{{ old('abdn_file_naming', $dataFileNaming->abdn_file_naming) }}">
                @error('abdnFileNaming')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="boqFileNaming" class="col-sm-2 col-form-label">BOQ</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="boqFileNaming" id="boqFileNaming" value="{{ old('boq_file_naming', $dataFileNaming->boq_file_naming) }}">
                @error('boqFileNaming')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
            <div class="mb-3 row">
                <label for="atfFileNaming" class="col-sm-2 col-form-label">ATF</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="atfFileNaming" id="atfFileNaming" value="{{ old('atf_file_naming', $dataFileNaming->atf_file_naming) }}">
                    @error('atfFileNaming')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        </div>
        <div class="mb-5 row">
            <label for="atpFileNaming" class="col-sm-2 col-form-label">ATP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="atpFileNaming" id="atpFileNaming" value="{{ old('atp_file_naming', $dataFileNaming->atp_file_naming) }}">
                @error('atpFileNaming')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
    </div>
        <div class="mb-1 row">
            <label for="button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> SAVE </button>
                <a href="{{ route('filenaming.index') }}" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
            </div>
        </div>
    </div>
</form>

@endsection