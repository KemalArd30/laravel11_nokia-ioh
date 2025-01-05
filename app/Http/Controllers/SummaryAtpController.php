<?php

namespace App\Http\Controllers;

use App\Models\Atp;
use App\Models\Implementasi;
use App\Models\Region;
use Illuminate\Http\Request;

class SummaryAtpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hitung total Impl Site Active
        $implSiteActive = Implementasi::where('status_site', 'ACTIVE')->count();

        // Hitung total FOA dengan status 'ACTIVE'
        $foas = Implementasi::joinWithPbiProject();
        $foa = $foas
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE'); // Menambahkan filter untuk 'ACTIVE'
            $foa = $foas->count();

            // Hitung total ATP NY Complete dengan status 'ACTIVE'
        $atpNyCompletes = Atp::JoinWithSitelistAndImplementasi();
        $atpNyComplete = $atpNyCompletes
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNull('doc_acceptance.atp_submit_date');
            $atpNyComplete = $atpNyCompletes->count();

            // Hitung total ATP On Review dengan status 'ACTIVE'
        $atpOnReviews = Atp::JoinWithSitelistAndImplementasi();
        $atpOnReview = $atpOnReviews
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('doc_acceptance.atp_submit_date')
            ->whereNull('doc_acceptance.atp_reject_date')
            ->where('doc_acceptance.atp_status', 'On Review')
            ->whereNull('doc_acceptance.atp_approved_date');
            $atpOnReview = $atpOnReviews->count();

            // Hitung total ATP On Review dengan status 'ACTIVE'
        $atpRejecteds = Atp::JoinWithSitelistAndImplementasi();
        $atpRejected = $atpRejecteds
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('doc_acceptance.atp_submit_date')
            ->whereNotNull('doc_acceptance.atp_reject_date')
            ->where('doc_acceptance.atp_status', 'Rejected')
            ->whereNull('doc_acceptance.atp_approved_date');
            $atpRejected = $atpRejecteds->count();

            // Hitung total ATP On Review dengan status 'ACTIVE'
        $atpApproveds = Atp::JoinWithSitelistAndImplementasi();
        $atpApproved = $atpApproveds
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('doc_acceptance.atp_submit_date')
            ->where('doc_acceptance.atp_status', 'Approved')
            ->whereNotNull('doc_acceptance.atp_approved_date');
            $atpApproved = $atpApproveds->count();

        // Hitung total NY Take Data dengan status 'ACTIVE'
        $nyTakeDataAtps = Atp::JoinWithSitelistAndImplementasi();
        $nyTakeDataAtp = $nyTakeDataAtps
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->where('doc_acceptance.status_take_data_atp_born', '<>', 'Approved')
            ->whereNull('doc_acceptance.atp_internal_review_date');
            $nyTakeDataAtp = $nyTakeDataAtps->count();

            // Hitung total ATP yang disubmit berdasarkan aging
        $agingLimit = 7; // dalam hari
        $agingCounts = Atp::countAtpSubmitByRegionalAndAging($agingLimit);

        // Siapkan data untuk chart dengan pengecekan
        $chartData = [
            'exceeded' => $agingCounts['exceeded'] ?? [],
            'notExceeded' => $agingCounts['notExceeded'] ?? [],
        ];


            // New logic for region summary
        $regions = Region::all();
        $summaryData = [];

        foreach ($regions as $region) {
            $summaryData[] = [
                'regional' => $region->regional,
                'implSiteActive' => Atp::JoinWithSitelistAndImplementasi()
                    ->where('regional_list.regional', $region->regional)
                    ->where('implementasi.status_site', 'ACTIVE')
                    ->count(),
                'fullOnAir' => Implementasi::joinWithPbiProject()
                    ->where('regional_list.regional', $region->regional)
                    ->where('implementasi.status_oa', 'FOA')
                    ->where('implementasi.status_site', 'ACTIVE')
                    ->count(),
                'nyTakeDataAtp' => Atp::JoinWithSitelistAndImplementasi()
                    ->where('regional_list.regional', $region->regional)
                    ->where('implementasi.status_oa', 'FOA')
                    ->where('implementasi.status_site', 'ACTIVE')
                    ->where(function($query) {
                        $query->where('doc_acceptance.status_take_data_atp_born', '<>', 'Approved')
                              ->orWhereNull('doc_acceptance.status_take_data_atp_born');
                    })
                    ->whereNull('doc_acceptance.atp_internal_review_date')
                    ->count(),
                'atpNyComplete' => Atp::JoinWithSitelistAndImplementasi()
                    ->where('regional_list.regional', $region->regional)
                    ->where('implementasi.status_oa', 'FOA')
                    ->where('implementasi.status_site', 'ACTIVE')
                    ->whereNull('doc_acceptance.atp_submit_date')
                    ->count(),
                'atpOnReview' => Atp::JoinWithSitelistAndImplementasi()
                    ->where('regional_list.regional', $region->regional)
                    ->where('implementasi.status_oa', 'FOA')
                    ->where('implementasi.status_site', 'ACTIVE')
                    ->whereNotNull('doc_acceptance.atp_submit_date')
                    ->whereNull('doc_acceptance.atp_reject_date')
                    ->where('doc_acceptance.atp_status', 'On Review')
                    ->whereNull('doc_acceptance.atp_approved_date')
                    ->count(),
                'atpRejected' => Atp::JoinWithSitelistAndImplementasi()
                    ->where('regional_list.regional', $region->regional)
                    ->where('implementasi.status_oa', 'FOA')
                    ->where('implementasi.status_site', 'ACTIVE')
                    ->whereNotNull('doc_acceptance.atp_submit_date')
                    ->whereNotNull('doc_acceptance.atp_reject_date')
                    ->where('doc_acceptance.atp_status', 'Rejected')
                    ->whereNull('doc_acceptance.atp_approved_date')
                    ->count(),

                'atpApproved' => Atp::JoinWithSitelistAndImplementasi()
                    ->where('regional_list.regional', $region->regional)
                    ->where('implementasi.status_oa', 'FOA')
                    ->where('implementasi.status_site', 'ACTIVE')
                    ->whereNotNull('doc_acceptance.atp_submit_date')
                    ->where('doc_acceptance.atp_status', 'Approved')
                    ->whereNotNull('doc_acceptance.atp_approved_date')
                    ->count(), // Pindahkan count() di sini untuk menghitung total
            ];
        }

        $oldNyTakeDataAtp = Atp::JoinWithSitelistAndImplementasi()
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE')
            ->where(function($query) {
                $query->where('doc_acceptance.status_take_data_atp_born', '<>', 'Approved')
                      ->orWhereNull('doc_acceptance.status_take_data_atp_born');
            })
            ->whereNull('doc_acceptance.atp_internal_review_date')
            ->selectRaw('DATEDIFF(CURDATE(), implementasi.oa_date) as days_diff') // Menghitung selisih hari
            ->oldest('implementasi.oa_date')
            ->get();

        $oldAtpNyComplete = Atp::JoinWithSitelistAndImplementasi()
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE')
            ->whereNull('doc_acceptance.atp_submit_date')
            ->selectRaw('DATEDIFF(CURDATE(), implementasi.oa_date) as days_diff') // Menghitung selisih hari
            ->oldest('implementasi.oa_date')
            ->get();

        $oldAtpRejected = Atp::JoinWithSitelistAndImplementasi()
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE')
            ->whereNotNull('doc_acceptance.atp_submit_date')
            ->whereNotNull('doc_acceptance.atp_reject_date')
            ->where('doc_acceptance.atp_status', 'Rejected')
            ->whereNull('doc_acceptance.atp_approved_date')
            ->selectRaw('DATEDIFF(CURDATE(), implementasi.oa_date) as days_diff') // Menghitung selisih hari
            ->oldest('implementasi.oa_date')
            ->get();

        $lastAtpSubmit = Atp::JoinWithSitelistAndImplementasi()
            ->whereNotNull('doc_acceptance.atp_submit_date')
            ->where('doc_acceptance.atp_status', 'On Review')
            ->whereNotNull('implementasi.oa_date')
            ->where('implementasi.status_site', 'ACTIVE')
            ->latest('doc_acceptance.atp_submit_date')
            ->take(5)
            ->get();
        
        $lastAtpApproved = Atp::JoinWithSitelistAndImplementasi()
            ->whereNotNull('doc_acceptance.atp_approved_date')
            ->where('doc_acceptance.atp_status', 'Approved')
            ->whereNotNull('implementasi.oa_date')
            ->where('implementasi.status_site', 'ACTIVE')
            ->latest('doc_acceptance.atp_approved_date')
            ->take(5)
            ->get();

        $needUploadAtpPpm = Atp::JoinWithSitelistAndImplementasi()
            ->whereNotNull('doc_acceptance.atp_approved_date')
            ->where('doc_acceptance.atp_status', 'Approved')
            ->whereNotNull('implementasi.oa_date')
            ->where('implementasi.status_site', 'ACTIVE')
            ->whereNull('doc_acceptance.url_atp_ppm')
            ->oldest('doc_acceptance.atp_approved_date')
            ->get();



        return view('dashboard.summaryAtp', compact(
            'implSiteActive', 'foa', 'nyTakeDataAtp', 'atpNyComplete', 'atpOnReview', 'atpRejected', 'atpApproved', 'summaryData', 'chartData', 
            'oldNyTakeDataAtp', 'oldAtpNyComplete', 'oldAtpRejected', 'lastAtpSubmit', 'lastAtpApproved', 'needUploadAtpPpm'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
