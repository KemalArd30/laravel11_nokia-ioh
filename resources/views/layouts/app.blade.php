<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- Other meta tags and title -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/layouts/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layouts/navtab.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layouts/sub-tab.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layouts/footer.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

</head>
<body class="bg-light">
    <!-- Navbar utama -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">NSN-IOH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-regular fa-user pe-2"></i>Profile</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa-solid fa-arrow-left pe-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="nav-tabs-container">
        <!-- Tabs Utama -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
            </li>
            @if (Auth::check() && Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" id="region-tab" data-bs-toggle="tab" href="#region" role="tab" aria-controls="region" aria-selected="true">Region</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" id="sitelist-tab" data-bs-toggle="tab" href="#sitelist" role="tab" aria-controls="sitelist" aria-selected="true">Sitelist</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tss-tab" data-bs-toggle="tab" href="#tss" role="tab" aria-controls="tss" aria-selected="false">TSS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="implementasi-tab" data-bs-toggle="tab" href="#implementasi" role="tab" aria-controls="implementasi" aria-selected="false">Implementasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="wcc-tab" data-bs-toggle="tab" href="#wcc" role="tab" aria-controls="wcc" aria-selected="false">WCC</a>
            </li>
            @if (Auth::check() && Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" id="admin-tab" data-bs-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
            </li>
            @endif
        </ul>

        <div class="tab-content">

            <!-- Dashboard Tab -->
            <div class="tab-pane" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Sub Tabs -->
                <div class="sub-tabs-container">
                    <ul class="nav sub-nav-tabs">
                        <li class="nav-item">
                            <a href='{{ url('summary') }}' class="nav-link"><i class="fa-solid fa-gauge fa-2x d-block"></i>
                                <span class="pt-2">All Summary</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('summaryTss') }}' class="nav-link"><i class="fa-solid fa-chart-bar fa-2x d-block"></i>
                                <span class="pt-2">Summary TSS</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('summaryAtp') }}' class="nav-link"><i class="fa-solid fa-chart-column fa-2x d-block"></i>
                                <span class="pt-2">Summary ATP</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='#' class="nav-link disabled" aria-disabled="true"><i class="fa-solid fa-magnifying-glass-dollar fa-2x d-block"></i>
                                <span class="pt-2">Summary WCC</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='#' class="nav-link disabled" aria-disabled="true"><i class="fa-solid fa-check-double fa-2x d-block"></i>
                                <span class="pt-2">ToDo Task</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Region Tab -->
            @if (Auth::check() && Auth::user()->hasRole('admin'))
            <div class="tab-pane" id="region" role="tabpanel" aria-labelledby="region-tab">
                <!-- Sub Tabs -->
                <div class="sub-tabs-container">
                    <ul class="nav sub-nav-tabs">
                        <li class="nav-item">
                            <a href='{{ url('region/create') }}' class="nav-link"><i class="fa-solid fa-earth-asia fa-2x d-block"></i>
                                <span class="pt-2">ADD REGION</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('region') }}' class="nav-link"><i class="fa-solid fa-table-list fa-2x d-block"></i>
                                <span class="pt-2">REGION LIST</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            <!-- Sitelist Tab -->
            <div class="tab-pane" id="sitelist" role="tabpanel" aria-labelledby="sitelist-tab">
                <!-- Sub Tabs -->
                <div class="sub-tabs-container">
                    <ul class="nav sub-nav-tabs">
                        @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href='{{ url('sitelist/create') }}' class="nav-link"><i class="fa-solid fa-map-location-dot fa-2x d-block"></i>
                                <span class="pt-2">ADD SITE</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href='{{ url('sitelist') }}' class="nav-link"><i class="fa-solid fa-list-ul fa-2x d-block"></i>
                                <span class="pt-2">SITE LIST</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('filenaming') }}' class="nav-link"><i class="fa-solid fa-font fa-2x d-block"></i>
                                <span class="pt-2">FILE NAMING</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- TSS Tab -->
            <div class="tab-pane" id="tss" role="tabpanel" aria-labelledby="tss-tab">
                <!-- Sub Tabs -->
                <div class="sub-tabs-container">
                    <ul class="nav sub-nav-tabs">
                        @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href='{{ url('tss/create') }}' class="nav-link"><i class="fa-solid fa-file-import fa-2x d-block"></i>
                                <span class="pt-2">PBI TSS</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href='{{ url('tss') }}' class="nav-link"><i class="fa-solid fa-table-list fa-2x d-block"></i>
                                <span class="pt-2">TSS</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('sid') }}' class="nav-link"><i class="fa-solid fa-square-pen fa-2x d-block"></i>
                                <span class="pt-2">SID</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Implementasi Tab -->
            <div class="tab-pane" id="implementasi" role="tabpanel" aria-labelledby="implementasi-tab">
                <!-- Sub Tabs -->
                <div class="sub-tabs-container">
                    <ul class="nav sub-nav-tabs">
                        @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href='{{ url('implementasi/create') }}' class="nav-link"><i class="fa-solid fa-file-import fa-2x d-block"></i>
                                <span class="pt-2">PBI PROJECT</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href='{{ url('implementasi') }}' class="nav-link"><i class="fa-solid fa-tower-broadcast fa-2x d-block"></i>
                                <span class="pt-2">ON AIR</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='#' class="nav-link disabled" aria-disabled="true"><i class="fa-solid fa-signal fa-2x d-block"></i>
                                <span class="pt-2">RFC</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('netgearMos') }}' class="nav-link"><i class="fa-solid fa-magnifying-glass-plus fa-2x d-block"></i>
                                <span class="pt-2">NETGEAR MOS</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('lldNdb') }}' class="nav-link"><i class="fa-regular fa-file-lines fa-2x d-block"></i>
                                <span class="pt-2">LLD/NDB</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('abd') }}' class="nav-link"><i class="fa-solid fa-pen fa-2x d-block"></i>
                                <span class="pt-2">ABD</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('boq') }}' class="nav-link"><i class="fa-solid fa-file-invoice fa-2x d-block"></i>
                                <span class="pt-2">BOQ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('atf') }}' class="nav-link"><i class="fa-solid fa-magnifying-glass-minus fa-2x d-block"></i>
                                <span class="pt-2">ATF</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('atp') }}' class="nav-link"><i class="fa-regular fa-circle-check fa-2x d-block"></i>
                                <span class="pt-2">ATP</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('acceptance') }}' class="nav-link"><i class="fa-solid fa-list-check fa-2x d-block"></i>
                                <span class="pt-2">ACCEPTANCE</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- WCC Tab -->
            <div class="tab-pane" id="wcc" role="tabpanel" aria-labelledby="wcc-tab">
                <!-- Sub Tabs -->
                <div class="sub-tabs-container">
                    <ul class="nav sub-nav-tabs">
                        @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href='{{ url('pbiWcc/create') }}' class="nav-link"><i class="fa-solid fa-file-import fa-2x d-block"></i>
                                <span class="pt-2">PBI WCC</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href='{{ url('wccFullPayment') }}' class="nav-link"><i class="fa-solid fa-coins fa-2x d-block"></i>
                                <span class="pt-2">WCC Full Pay</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='#' class="nav-link disabled" aria-disabled="true"><i class="fa-solid fa-money-bill fa-2x d-block"></i>
                                <span class="pt-2">WCC 1st Pay</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='#' class="nav-link disabled" aria-disabled="true"><i class="fa-solid fa-money-bill fa-2x d-block"></i>
                                <span class="pt-2">WCC 2nd Pay</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ADMIN Tab -->
            <div class="tab-pane" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                <!-- Sub Tabs -->
                <div class="sub-tabs-container">
                    <ul class="nav sub-nav-tabs">
                        <li class="nav-item">
                            <a href='{{ url('users/create') }}' class="nav-link"><i class="fa-solid fa-user-plus fa-2x d-block"></i>
                                <span class="pt-2">Add User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ url('users') }}' class="nav-link"><i class="fa-solid fa-users fa-2x d-block"></i>
                                <span class="pt-2">List User</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <main class="content px-5 py-0">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>
</body>
<footer class="text-left px-5 py-0 ms-3 mt-4">
    <p>Made with ❤️ by Kemal Ardiansyah</p>
</footer>

</html>