@extends('layouts.app')

@section('title', 'Summary TSS')

@section('content')

<!-- Other meta tags and title -->
<script src="{{ asset('js/chart-tss/slaTssSubmission.js') }}"></script>
<script id="chartData" type="application/json">
    @json($chartData)
</script>

<div class="bg-body rounded shadow-sm mt-4 p-3">
    
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-2 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Site Active</h6>
                            <h2 class="mt-2 mb-0">{{ $tssSiteActive }}</h2>
                        </div>
                        <i class="fas fa-solid fa-list-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">Need Survey</h6>
                            <h2 class="mt-2 mb-0">{{ $tssNeedSurvey }}</h2>
                        </div>
                        <i class="fas fa-solid fa-circle-exclamation fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">TSS Need Submit</h6>
                            <h2 class="mt-2 mb-0">{{ $tssNeedSubmit }}</h2>
                        </div>
                        <i class="fas fa-solid fa-arrow-up-from-bracket fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">TSS On Review</h6>
                            <h2 class="mt-2 mb-0">{{ $tssOnReview }}</h2>
                        </div>
                        <i class="fas fa-reguler fa-eye fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">TSS Approved</h6>
                            <h2 class="mt-2 mb-0">{{ $tssApproved }}</h2>
                        </div>
                        <i class="fas fa-reguler fa-circle-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-secondary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-0">TSSR Need Upload PPM</h6>
                            <h2 class="mt-2 mb-0">{{ $tssNeedUploadPpm }}</h2>
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
                <div class="card-body"  style="height: 300px;">
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th>Regional</th>
                                    <th class="text-center">Site Active</th>
                                    <th class="text-center">Need Survey</th>
                                    <th class="text-center">TSS Need Submit</th>
                                    <th class="text-center">TSS On Review</th>
                                    <th class="text-center">TSS Approved</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($summaryData as $data)
                                    <tr>
                                        <td>{{ $data['regional'] }}</td>
                                        <td class="text-center">{{ $data['tssSiteActive'] }}</td>
                                        <td class="text-center">{{ $data['tssNeedSurvey'] }}</td>
                                        <td class="text-center">{{ $data['tssNeedSubmit'] }}</td>
                                        <td class="text-center">{{ $data['tssOnReview'] }}</td>
                                        <td class="text-center">{{ $data['tssApproved'] }}</td>
                                    </tr>
                                @endforeach
                                <tr class="fw-bold">
                                    <td>Total</td>
                                    <td class="text-center">{{ $tssSiteActive }}</td>
                                    <td class="text-center">{{ $tssNeedSurvey }}</td>
                                    <td class="text-center">{{ $tssNeedSubmit }}</td>
                                    <td class="text-center">{{ $tssOnReview }}</td>
                                    <td class="text-center">{{ $tssApproved }}</td>
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
                    <h5 class="mb-0"><i class="fas fa-solid fa-chart-simple me-2"></i>Performance TSS Submission</h5>
                </div>
                <div class="card-body" style="height: 300px;">
                    <canvas id="slaTssSubmissionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Need Survey</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                        <ul class="list-group">
                            @forelse($oldNeedSurvey as $needSurvey)
                                <li class="list-group-item">
                                    <strong class="d-flex justify-content-between">
                                        <span>{{ $needSurvey->site_id }} {{ $needSurvey->site_name }}</span>
                                    </strong>
                                    <small>Regional : {{ $needSurvey->regional }}</small>
                                    <br>
                                    <small>Project : {{ $needSurvey->phase_name }}</small>
                                    @empty
                                    <strong class="text-center">No Data </strong>
                                </li>
                            @endforelse
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
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>TSS Need Submit</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                    <ul class="list-group">
                        @forelse($tssNeedSubmit2 as $tssNeedSubmit)
                            <li class="list-group-item">
                                <strong class="d-flex justify-content-between">
                                    <span>{{ $tssNeedSubmit->site_id }} {{ $tssNeedSubmit->site_name }}</span>
                                    <span>{{ $tssNeedSubmit->days_diff }} Days</span>
                                    </strong>
                                <small>Regional : {{ $tssNeedSubmit->regional }}</small>
                                <br>
                                <small>Project : {{ $tssNeedSubmit->phase_name }}</small>
                                @empty
                                    <strong class="text-center">No Data </strong>
                                </li>
                            </li>
                        @endforelse
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
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Need Create SID & Upload PPM</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                    <ul class="list-group">
                        @foreach($needCreateSid as $needSid)
                            <li class="list-group-item">
                                <strong class="d-flex justify-content-between">
                                <span>{{ $needSid->site_id }} {{ $needSid->site_name }}</span>
                                <span>
                                    <a href="{{ route('sid.edit', $needSid->id_tss) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Update
                                    </a>
                                </span>
                                </strong>
                                <small>Regional : {{ $needSid->regional }}</small>
                                <br>
                                <small>Project : {{ $needSid->phase_name }}</small>
                            </li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="mt-3 text-end">
                        <a href='{{ url('sid') }}' style='text-decoration: none;'>
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
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>TSSR Need Upload PPM</h5>
                </div>
                <div class="card-body d-flex flex-column" style="height: 500px;">
                    <div class="flex-grow-1" style="overflow-y: auto;">
                    <ul class="list-group">
                        @foreach($needUploadTssPpm as $needUploadTss)
                            <li class="list-group-item">
                                <strong class="d-flex justify-content-between">
                                <span>{{ $needUploadTss->site_id }} {{ $needUploadTss->site_name }}</span>
                                <span>
                                    <a href="{{ route('tss.edit', $needUploadTss->id_tss) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Update
                                    </a>
                                </span>
                                </strong>
                                <small>Regional : {{ $needUploadTss->regional }}</small>
                                <br>
                                <small>Project : {{ $needUploadTss->phase_name }}</small>
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