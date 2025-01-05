<?php

namespace App\Http\Controllers;

use App\Models\WccFullPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WccFullPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua filter dari request
        $filters = $request->only([
            'project_year', 'display_status_site', 'regional', 'zone', 
            'area', 'system_key', 'site_id', 'site_name', 'smp_id', 'module_id', 'phase_name',
            'service_task', 'display_doc_approved_date', 'spo_number', 'spo_date',
            'wcc_assign_by_nokia', 'wcc_submit_date', 'wcc_reject_date',
            'wcc_verification_date', 'wcc_approve_date', 'wcc_status', 'remark',
        ]);

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Query awal, join tabel dan ambil data yang diperlukan
        $query = WccFullPayment::JoinToWccFullPayment();

        if ($user && !$user->hasRole('admin') && $user->regional !== 'HEAD OFFICE' && $user->regional) {
            $query->where('regional_list.regional', $user->regional);
        }

        // Filter berdasarkan project year
        if (!empty($filters['project_year'])) {
            $query->where('site_list.project_year', $filters['project_year']);
        }

        // Filter berdasarkan status site
        if (!empty($filters['display_status_site'])) {
            $query->where('implementasi_status_site', $filters['status_site']);
        }

        // Filter berdasarkan regional
        if (!empty($filters['regional'])) {
            $query->where('regional_list.regional', 'like', '%' . $filters['regional'] . '%');
        }

        // Filter berdasarkan zone
        if (!empty($filters['zone'])) {
            $query->where('site_list.zone', 'like', '%' . $filters['zone'] . '%');
        }

        // Filter berdasarkan area
        if (!empty($filters['area'])) {
            $query->where('site_list.area', 'like', '%' . $filters['area'] . '%');
        }

        // Filter berdasarkan system key
        if (!empty($filters['system_key'])) {
            $query->where('site_list.system_key', 'like', '%' . $filters['system_key'] . '%');
        }

        // Filter berdasarkan site ID
        if (!empty($filters['site_id'])) {
            $query->where('site_list.site_id', 'like', '%' . $filters['site_id'] . '%');
        }

        // Filter berdasarkan site name
        if (!empty($filters['site_name'])) {
            $query->where('site_list.site_name', 'like', '%' . $filters['site_name'] . '%');
        }

        // Filter berdasarkan SMP-ID
        if (!empty($filters['smp_id'])) {
            $query->where('site_list.smp_id', 'like', '%' . $filters['smp_id'] . '%');
        }

        // Filter berdasarkan Module ID
        if (!empty($filters['module_id'])) {
            $query->where('pbi_wcc_full_payment_data.ewcc_module_id', 'like', '%' . $filters['module_id'] . '%');
        }

        // Filter berdasarkan Phase Name
        if (!empty($filters['phase_name'])) {
            $query->where('site_list.phase_name', 'like', '%' . $filters['phase_name'] . '%');
        }

        /// Filter berdasarkan service task
        if (!empty($filters['service_task'])) {
            $query->where(DB::raw('CASE
                WHEN pbi_wcc_full_payment_data.smp_id IS NULL AND wcc_full_pay.id_scope LIKE "%NSN_IOH_TSS%" THEN "STL11 NI TSS"
                WHEN pbi_wcc_full_payment_data.smp_id IS NULL AND wcc_full_pay.id_scope LIKE "%NSN_IOH_IMPL%" THEN "STL21 NI IMPL"
                WHEN pbi_wcc_full_payment_data.smp_id IS NULL AND wcc_full_pay.id_scope LIKE "%NSN_IOH_OTHER%" THEN "STL24 NI OTHERS"
                ELSE pbi_wcc_full_payment_data.service_task
            END'), 'like', '%' . $filters['service_task'] . '%');
        }

        // Filter berdasarkan Doc Approved Date
        if (!empty($filters['display_doc_approved_date'])) {
            $query->where('doc_acceptance_approved_date', $filters['doc_acceptance_approved_date']);
        }

        // Ambil hasil filter dan pagination
        $dataWccFullPayment = $query->distinct()->paginate(10);

        // debugging
        // dd($dataWccFullPayment);

        // Untuk permintaan biasa, tampilkan seluruh halaman
        return view('wcc.wccFullPayment', compact('dataWccFullPayment'));
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
