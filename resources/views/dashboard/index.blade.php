@extends('layouts.app')

@section('title', 'Summary')

@section('content')
<div class="bg-body rounded shadow-sm mt-4 p-3">
    
    <div class="row">
        <div class="col-md-2 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Site Assignment</h6>
                            <h2 class="mt-2 mb-0">{{ $totalAssignment }}</h2>
                        </div>
                        <i class="fas fa-solid fa-list-ul fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Site Active</h6>
                            <h2 class="mt-2 mb-0">{{ $siteActive }}</h2>
                        </div>
                        <i class="fas fa-solid fa-list-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Survey Approved</h6>
                            <h2 class="mt-2 mb-0">{{ $surveyApproved }}</h2>
                        </div>
                        <i class="fas fa-solid fa-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Full On Air</h6>
                            <h2 class="mt-2 mb-0">{{ $foa }}</h2>
                        </div>
                        <i class="fas fa-solid fa-tower-broadcast fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">ATP Approved</h6>
                            <h2 class="mt-2 mb-0">{{ $atpApproved }}</h2>
                        </div>
                        <i class="fas fa-solid fa-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">WCC</h6>
                            <h5 class="mt-2 mb-0">Under Construction</h5>
                        </div>
                        <i class="fas fa-solid fa-wrench fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-solid fa-table-cells-large me-2"></i>Table Summary</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>Regional</th>
                                <th class="text-center">Site Assignment</th>
                                <th class="text-center">Site Active</th>
                                <th class="text-center">Survey Approved</th>
                                <th class="text-center">Full On Air</th>
                                <th class="text-center">ATP Approved</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($summaryData as $data)
                                <tr>
                                    <td>{{ $data['regional'] }}</td>
                                    <td class="text-center">{{ $data['totalAssignment'] }}</td>
                                    <td class="text-center">{{ $data['siteActive'] }}</td>
                                    <td class="text-center">{{ $data['surveyApproved'] }}</td>
                                    <td class="text-center">{{ $data['foa'] }}</td>
                                    <td class="text-center">{{ $data['atpApproved'] }}</td>
                                </tr>
                            @endforeach
                            <tr class="fw-bold">
                                <td>Total</td>
                                <td class="text-center">{{ $totalAssignment }}</td>
                                <td class="text-center">{{ $siteActive }}</td>
                                <td class="text-center">{{ $surveyApproved }}</td>
                                <td class="text-center">{{ $foa }}</td>
                                <td class="text-center">{{ $atpApproved }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Last TSS Submit</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                        <ul class="list-group">
                            @foreach($lastTssSubmit as $tssSubmit)
                                <li class="list-group-item">
                                    <strong class="d-flex justify-content-between">
                                        <span>{{ $tssSubmit->site_id }} {{ $tssSubmit->site_name }}</span>
                                        <span>{{ $tssSubmit->review_by_scm }}</span>
                                    </strong>
                                    <small>Regional : {{ $tssSubmit->regional }}</small>
                                    <br>
                                    <small>Project : {{ $tssSubmit->phase_name }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-3 text-end">
                        <a href='{{ url('tss') }}' style='text-decoration: none;'>
                            Go to Data <i class="fa-solid fa-right-long ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Last TSS Approved</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                    <ul class="list-group">
                        @foreach($lastTssApproved as $tssApproved)
                            <li class="list-group-item">
                                <strong class="d-flex justify-content-between">
                                    <span>{{ $tssApproved->site_id }} {{ $tssApproved->site_name }}</span>
                                    <span>{{ $tssApproved->tssr_done }}</span>
                                    </strong>
                                <small>Regional : {{ $tssApproved->regional }}</small>
                                <br>
                                <small>Project : {{ $tssApproved->phase_name }}</small>
                            </li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="mt-3 text-end">
                        <a href='{{ url('tss') }}' style='text-decoration: none;'>
                            Go to Data <i class="fa-solid fa-right-long ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Last Full On Air</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                    <ul class="list-group">
                        @foreach($lastFullOnAir as $fullOnAir)
                            <li class="list-group-item">
                                <strong class="d-flex justify-content-between">
                                <span>{{ $fullOnAir->site_id }} {{ $fullOnAir->site_name }}</span>
                                <span>{{ $fullOnAir->oa_date }}</span>
                            </strong>
                                <small>Regional : {{ $fullOnAir->regional }}</small>
                                <br>
                                <small>Project : {{ $fullOnAir->phase_name }}</small>
                            </li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="mt-3 text-end">
                        <a href='{{ url('implementasi') }}' style='text-decoration: none;'>
                            Go to Data <i class="fa-solid fa-right-long ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Last ATP Submit</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                    <ul class="list-group">
                        @foreach($lastAtpSubmit as $atpSubmit)
                            <li class="list-group-item">
                                <strong class="d-flex justify-content-between">
                                <span>{{ $atpSubmit->site_id }} {{ $atpSubmit->site_name }}</span>
                                <span>{{ $atpSubmit->atp_submit_date }}</span>
                                </strong>
                                <small>Regional : {{ $atpSubmit->regional }}</small>
                                <br>
                                <small>Project : {{ $atpSubmit->phase_name }}</small>
                            </li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="mt-3 text-end">
                        <a href='{{ url('acceptance') }}' style='text-decoration: none;'>
                            Go to Data <i class="fa-solid fa-right-long ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Last ATP Approved</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                    <ul class="list-group">
                        @foreach($lastAtpApproved as $atpApproved)
                            <li class="list-group-item">
                                <strong class="d-flex justify-content-between">
                                <span>{{ $atpApproved->site_id }} {{ $atpApproved->site_name }}</span>
                                <span>{{ $atpApproved->atp_approved_date }}</span>
                                </strong>
                                <small>Regional : {{ $atpApproved->regional }}</small>
                                <br>
                                <small>Project : {{ $atpApproved->phase_name }}</small>
                            </li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="mt-3 text-end">
                        <a href='{{ url('acceptance') }}' style='text-decoration: none;'>
                            Go to Data <i class="fa-solid fa-right-long ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Last WCC Submit</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                    <ul class="list-group">
                        <strong>UNDER CONSTRUCTION</strong>
                    </ul>
                    </div>
                    <div class="mt-3 text-end">
                        <a href='#' style='text-decoration: none;'>
                            Go to Data <i class="fa-solid fa-right-long ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    .card-header {
        font-weight: bold;
    }
</style>
@endpush