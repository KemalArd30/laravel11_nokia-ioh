<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Tss;
use Illuminate\Http\Request;

class SummaryTssController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Hitung total TSS Site Active
        $tssSiteActive = Tss::where('status_site', 'ACTIVE')->count();

        // Hitung total Need Survey dengan status 'ACTIVE'
        $tssNeedSurvey = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNull('pbi_tss.fill_tss_checklist_1_done')
            ->whereNull('pbi_tss.fill_tss_checklist_2_done')
            ->whereNull('pbi_tss.fill_tss_checklist_complete')
            ->whereNull('pbi_tss.review_by_scm')
            ->whereNull('pbi_tss.review_by_pe')
            ->whereNull('pbi_tss.tssr_done')
            ->count(); // Menghitung total

        // Hitung total TSS Need Submit dengan status 'ACTIVE'
        $tssNeedSubmit = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
            ->whereNull('pbi_tss.review_by_scm')
            ->whereNull('pbi_tss.review_by_pe')
            ->whereNull('pbi_tss.tssr_done')
            ->count(); // Menghitung total

        // Hitung total TSS On Review dengan status 'ACTIVE'
        $tssOnReview = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
            ->whereNotNull('pbi_tss.review_by_scm')
            ->whereNull('pbi_tss.review_by_pe')
            ->whereNull('pbi_tss.tssr_done')
            ->count(); // Menghitung total

        // Hitung total TSS Approved dengan status 'ACTIVE'
        $tssApproved = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
            ->whereNotNull('pbi_tss.review_by_scm')
            ->whereNotNull('pbi_tss.review_by_pe')
            ->whereNotNull('pbi_tss.tssr_done')
            ->count(); // Menghitung total

            // Hitung total TSS Need Upload PPM dengan status 'ACTIVE'
        $tssNeedUploadPpm = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
            ->whereNotNull('pbi_tss.review_by_scm')
            ->whereNotNull('pbi_tss.review_by_pe')
            ->whereNotNull('pbi_tss.tssr_done')
            ->whereNull('tss.url_tssr_ppm')
            ->count(); // Menghitung total

            // Hitung total TSS yang disubmit berdasarkan aging
        $agingLimit = 3; // dalam hari
        $agingCounts = Tss::countTssSubmitByRegionalAndAging($agingLimit);

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
                'tssSiteActive' => Tss::JoinWithPbiTss()
                    ->where('regional_list.regional', $region->regional)
                    ->where('tss.status_site', 'ACTIVE')
                    ->count(),
                'tssNeedSurvey' => Tss::JoinWithPbiTss()
                    ->where('regional_list.regional', $region->regional)
                    ->whereNotNull('pbi_tss.scm_assigned_to_fst')
                    ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
                    ->whereNull('pbi_tss.fill_tss_checklist_1_done')
                    ->whereNull('pbi_tss.fill_tss_checklist_2_done')
                    ->whereNull('pbi_tss.fill_tss_checklist_complete')
                    ->whereNull('pbi_tss.review_by_scm')
                    ->whereNull('pbi_tss.review_by_pe')
                    ->whereNull('pbi_tss.tssr_done')
                    ->count(),
                'tssNeedSubmit' => Tss::JoinWithPbiTss()
                    ->where('regional_list.regional', $region->regional)
                    ->whereNotNull('pbi_tss.scm_assigned_to_fst')
                    ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
                    ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
                    ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
                    ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
                    ->whereNull('pbi_tss.review_by_scm')
                    ->whereNull('pbi_tss.review_by_pe')
                    ->whereNull('pbi_tss.tssr_done')
                    ->count(),
                'tssOnReview' => Tss::JoinWithPbiTss()
                    ->where('regional_list.regional', $region->regional)
                    ->whereNotNull('pbi_tss.scm_assigned_to_fst')
                    ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
                    ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
                    ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
                    ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
                    ->whereNotNull('pbi_tss.review_by_scm')
                    ->whereNull('pbi_tss.review_by_pe')
                    ->whereNull('pbi_tss.tssr_done')
                    ->count(),
                'tssApproved' => Tss::JoinWithPbiTss()
                    ->where('regional_list.regional', $region->regional)
                    ->whereNotNull('pbi_tss.scm_assigned_to_fst')
                    ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
                    ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
                    ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
                    ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
                    ->whereNotNull('pbi_tss.review_by_scm')
                    ->whereNotNull('pbi_tss.review_by_pe')
                    ->whereNotNull('pbi_tss.tssr_done')
                    ->count(), // Pindahkan count() di sini untuk menghitung total
            ];
        }

        $oldNeedSurvey = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNull('pbi_tss.fill_tss_checklist_1_done')
            ->whereNull('pbi_tss.fill_tss_checklist_2_done')
            ->whereNull('pbi_tss.fill_tss_checklist_complete')
            ->whereNull('pbi_tss.review_by_scm')
            ->whereNull('pbi_tss.review_by_pe')
            ->whereNull('pbi_tss.tssr_done')
            ->oldest('pbi_tss.scm_assigned_to_fst')
            ->get();

        $tssNeedSubmit2 = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
            ->whereNull('pbi_tss.review_by_scm')
            ->whereNull('pbi_tss.review_by_pe')
            ->whereNull('pbi_tss.tssr_done')
            ->selectRaw('DATEDIFF(CURDATE(), pbi_tss.scm_assigned_to_fst) as days_diff') // Menghitung selisih hari
            ->oldest('pbi_tss.fill_tss_checklist_complete')
            ->get();

        $needCreateSid = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
            ->whereNull('tss.url_sid_ppm')
            ->oldest('pbi_tss.fill_tss_checklist_complete')
            ->get();

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

        $needUploadTssPpm = Tss::JoinWithPbiTss()
            ->whereNotNull('pbi_tss.scm_assigned_to_fst')
            ->where('tss.status_site', 'ACTIVE') // Menambahkan filter untuk 'ACTIVE'
            ->whereNotNull('pbi_tss.fill_tss_checklist_1_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_2_done')
            ->whereNotNull('pbi_tss.fill_tss_checklist_complete')
            ->whereNotNull('pbi_tss.review_by_scm')
            ->whereNotNull('pbi_tss.review_by_pe')
            ->whereNotNull('pbi_tss.tssr_done')
            ->whereNull('tss.url_tssr_ppm')
            ->oldest('pbi_tss.tssr_done')
            ->get();

        return view('dashboard.summaryTss', compact(
            'tssSiteActive', 'tssNeedSurvey', 'tssNeedSubmit', 'tssOnReview', 'tssApproved', 'tssNeedUploadPpm', 'summaryData', 'oldNeedSurvey',
            'tssNeedSubmit2', 'needCreateSid', 'needUploadTssPpm', 'lastTssSubmit', 'lastTssApproved', 'chartData'
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
