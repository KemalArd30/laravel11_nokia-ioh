@extends('layouts.app')

@section('title', 'Summary ATP')

@section('content')

<!-- Other meta tags and title -->
<script src="{{ asset('js/chart-atp/slaAtpSubmission.js') }}"></script>
<script id="chartData" type="application/json">
    @json($chartData)
</script>

<div class="bg-body rounded shadow-sm mt-4 p-4">
    
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-2 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Site Active</h6>
                            <h2 class="mt-2 mb-0">{{ $implSiteActive }}</h2>
                        </div>
                        <i class="fas fa-solid fa-list-check fa-3x opacity-50"></i>
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
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">ATP NY Complete</h6>
                            <h2 class="mt-2 mb-0">{{ $atpNyComplete }}</h2>
                        </div>
                        <i class="fas fa-solid fa-circle-exclamation fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">ATP On Review</h6>
                            <h2 class="mt-2 mb-0">{{ $atpOnReview }}</h2>
                        </div>
                        <i class="fas fa-reguler fa-eye fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">ATP Rejected</h6>
                            <h2 class="mt-2 mb-0">{{ $atpRejected }}</h2>
                        </div>
                        <i class="fas fa-reguler fa-circle-xmark fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">ATP Approved</h6>
                            <h2 class="mt-2 mb-0">{{ $atpApproved }}</h2>
                        </div>
                        <i class="fas fa-reguler fa-circle-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row d-flex justify-content-center align-items-center">
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
                                    <th class="text-center">Site Active</th>
                                    <th class="text-center">Full On Air</th>
                                    <th class="text-center">NY Take Data ATP</th>
                                    <th class="text-center">ATP NY Complete</th>
                                    <th class="text-center">ATP On Review</th>
                                    <th class="text-center">ATP Rejected</th>
                                    <th class="text-center">ATP Approved</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($summaryData as $data)
                                    <tr>
                                        <td>{{ $data['regional'] }}</td>
                                        <td class="text-center">{{ $data['implSiteActive'] }}</td>
                                        <td class="text-center">{{ $data['fullOnAir'] }}</td>
                                        <td class="text-center">{{ $data['nyTakeDataAtp'] }}</td>
                                        <td class="text-center">{{ $data['atpNyComplete'] }}</td>
                                        <td class="text-center">{{ $data['atpOnReview'] }}</td>
                                        <td class="text-center">{{ $data['atpRejected'] }}</td>
                                        <td class="text-center">{{ $data['atpApproved'] }}</td>
                                    </tr>
                                @endforeach
                                <tr class="fw-bold">
                                    <td>Total</td>
                                    <td class="text-center">{{ $implSiteActive }}</td>
                                    <td class="text-center">{{ $foa }}</td>
                                    <td class="text-center">{{ $nyTakeDataAtp }}</td>
                                    <td class="text-center">{{ $atpNyComplete }}</td>
                                    <td class="text-center">{{ $atpOnReview }}</td>
                                    <td class="text-center">{{ $atpRejected }}</td>
                                    <td class="text-center">{{ $atpApproved }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-solid fa-chart-simple me-2"></i>Performance ATP Submission</h5>
                </div>
                <div class="card-body" style="height: 300px;">
                    <canvas id="slaAtpSubmissionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>NY Take Data ATP</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                        <ul class="list-group">
                            @foreach($oldNyTakeDataAtp as $NyTakeDataAtp)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong>{{ $NyTakeDataAtp->site_id }} - {{ $NyTakeDataAtp->site_name }}</strong>
                                        <div class="mt-1">
                                            <small class="d-block">Regional : {{ $NyTakeDataAtp->regional }}</small>
                                            <small class="d-block">Project : {{ $NyTakeDataAtp->phase_name }}</small>
                                            <small class="d-block">Remark : {{ $NyTakeDataAtp->remark }}</small>
                                        </div>
                                    </div>
                                    <div class="col-2 text-end">
                                        <strong>
                                        <span class="mb-1 mt-1 d-inline-block">
                                            {{ $NyTakeDataAtp->days_diff }} Days
                                        </span>
                                        </strong>
                                        <a href="{{ route('atp.edit', $NyTakeDataAtp->id_implementasi) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Update
                                        </a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-3 text-end">
                        <a href='{{ url('atp') }}' style='text-decoration: none;'>
                            Go to Data <i class="fa-solid fa-right-long ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>ATP NY Complete</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                        <ul class="list-group">
                            @foreach($oldAtpNyComplete as $AtpNyComplete)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong>{{ $AtpNyComplete->site_id }} - {{ $AtpNyComplete->site_name }}</strong>
                                        <div class="mt-1">
                                            <small class="d-block">Regional : {{ $AtpNyComplete->regional }}</small>
                                            <small class="d-block">Project : {{ $AtpNyComplete->phase_name }}</small>
                                            <small class="d-block">Remark : {{ $AtpNyComplete->remark }}</small>
                                        </div>
                                    </div>
                                    <div class="col-2 text-end">
                                        <strong>
                                        <span class="mb-1 mt-1 d-inline-block">
                                            {{ $AtpNyComplete->days_diff }} Days
                                        </span>
                                        </strong>
                                        <a href="{{ route('acceptance.edit', $AtpNyComplete->id_implementasi) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Update
                                        </a>
                                    </div>
                                </div>
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
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>ATP Rejected</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                        <ul class="list-group">
                            @foreach($oldAtpRejected as $AtpRejected)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong>{{ $AtpRejected->site_id }} - {{ $AtpRejected->site_name }}</strong>
                                        <div class="mt-1">
                                            <small class="d-block">Regional : {{ $AtpRejected->regional }}</small>
                                            <small class="d-block">Project : {{ $AtpRejected->phase_name }}</small>
                                            <small class="d-block">Remark : {{ $AtpRejected->remark }}</small>
                                        </div>
                                    </div>
                                    <div class="col-2 text-end">
                                        <strong>
                                        <span class="mb-1 mt-1 d-inline-block">
                                            {{ $AtpRejected->days_diff }} Days
                                        </span>
                                        </strong>
                                        <a href="{{ route('acceptance.edit', $AtpNyComplete->id_implementasi) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Update
                                        </a>
                                    </div>
                                </div>
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
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>ATP Approved Need Upload PPM</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                        <ul class="list-group">
                            @foreach($needUploadAtpPpm as $nyUploadAtpPpm)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong>{{ $nyUploadAtpPpm->site_id }} - {{ $nyUploadAtpPpm->site_name }}</strong>
                                        <div class="mt-1">
                                            <small class="d-block">Regional : {{ $nyUploadAtpPpm->regional }}</small>
                                            <small class="d-block">Project : {{ $nyUploadAtpPpm->phase_name }}</small>
                                            <small class="d-block">Remark : {{ $nyUploadAtpPpm->remark }}</small>
                                        </div>
                                    </div>
                                    <div class="col-2 text-end">
                                        <a href="{{ route('acceptance.edit', $nyUploadAtpPpm->id_implementasi) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Update
                                        </a>
                                    </div>
                                </div>
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