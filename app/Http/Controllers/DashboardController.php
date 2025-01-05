<?php

namespace App\Http\Controllers;

use App\Models\Atp;
use App\Models\Implementasi;
use App\Models\Region;
use App\Models\Sitelist;
use App\Models\Tss;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Hitung total Assignment
        $totalAssignment = Sitelist::count();

        // Hitung total Site Active
        $siteActive = Sitelist::where('status_site', 'ACTIVE')->count();

        // Hitung total Survey Approved dengan status 'ACTIVE'
        $query = Tss::JoinWithPbiTss();
        $surveyApproved = $query
            ->where('pbi_tss.tssr_done', '!=', null)
            ->where('tss.status_site', 'ACTIVE'); // Menambahkan filter untuk 'ACTIVE'
            $surveyApproved = $query->count();


        // Hitung total FOA dengan status 'ACTIVE'
        $foas = Implementasi::joinWithPbiProject();
        $foa = $foas
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE'); // Menambahkan filter untuk 'ACTIVE'
            $foa = $foas->count();

        
            // Hitung total ATP dengan status 'ACTIVE'
        $atpApprovedStatus = Atp::JoinWithSitelistAndImplementasi();
        $atpApproved = $atpApprovedStatus
            ->where('doc_acceptance.atp_status', 'Approved')
            ->where('implementasi.status_site', 'ACTIVE'); // Menambahkan filter untuk 'ACTIVE'
            $atpApproved = $atpApprovedStatus->count();


            // New logic for region summary
    $regions = Region::all();
    $summaryData = [];

    foreach ($regions as $region) {
    $summaryData[] = [
        'regional' => $region->regional,
        'totalAssignment' => Sitelist::join('regional_list AS rl1', 'site_list.coa', '=', 'rl1.coa')
            ->where('rl1.regional', $region->regional)
            ->count(),
        'siteActive' => Sitelist::join('regional_list AS rl2', 'site_list.coa', '=', 'rl2.coa')
            ->where('rl2.regional', $region->regional)
            ->where('site_list.status_site', 'ACTIVE')
            ->count(),
        'surveyApproved' => Tss::JoinWithPbiTss()
            ->where('regional_list.regional', $region->regional)
            ->where('pbi_tss.tssr_done', '!=', null)
            ->where('tss.status_site', 'ACTIVE')
            ->count(),
        'foa' => Implementasi::select('implementasi.*')
            ->join('site_list', 'implementasi.id_sitelist', '=', 'site_list.id_sitelist')
            ->join('regional_list AS rl3', 'site_list.coa', '=', 'rl3.coa')
            ->where('rl3.regional', $region->regional)
            ->where('implementasi.status_oa', 'FOA')
            ->where('implementasi.status_site', 'ACTIVE')
            ->count(),
        'atpApproved' => Atp::JoinWithSitelistAndImplementasi()
            ->join('regional_list AS rl4', 'site_list.coa', '=', 'rl4.coa')
            ->where('rl4.regional', $region->regional)
            ->where('doc_acceptance.atp_status', 'Approved')
            ->where('implementasi.status_site', 'ACTIVE')
            ->count(),
            ];
        }

        $lastTssSubmit = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.review_by_scm')
            ->where('tss.status_site', 'ACTIVE')
            ->latest('pbi_tss.review_by_scm')
            ->take(5)
            ->get();

        $lastTssApproved = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.tssr_done')
            ->where('tss.status_site', 'ACTIVE')
            ->latest('pbi_tss.tssr_done')
            ->take(5)
            ->get();

        $lastFullOnAir = Implementasi::joinWithPbiProject()
            ->whereNotNull('implementasi.oa_date')
            ->where('implementasi.status_site', 'ACTIVE')
            ->latest('implementasi.oa_date')
            ->take(5)
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


        return view('dashboard.index', compact(
            'totalAssignment', 'siteActive', 'surveyApproved', 'foa', 'atpApproved',
            'lastTssSubmit', 'summaryData', 'lastTssApproved', 'lastFullOnAir', 'lastAtpSubmit', 'lastAtpApproved'
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
