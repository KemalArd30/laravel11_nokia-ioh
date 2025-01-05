<?php

namespace App\Http\Controllers;

use App\Models\Atp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua filter dari request
        $filters = $request->only([
            'project_year', 'status_site', 'regional', 'zone', 
            'area', 'system_key', 'site_id', 'site_name', 'smp_id', 'phase_name', 'oa_date', 'status_oa',
            'status_task_atp_born', 'status_take_data_atp_born', 'atp_internal_review_date', 
            'pic_atp_internal_review', 'remark',
        ]);

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Query awal, join tabel dan ambil data yang diperlukan
        $query = Atp::JoinWithSitelistAndImplementasi()->distinct();

        if ($user && !$user->hasRole('admin') && $user->regional !== 'HEAD OFFICE' && $user->regional) {
            $query->where('regional_list.regional', $user->regional);
        }

        // Filter berdasarkan project year
        if (!empty($filters['project_year'])) {
            $query->where('site_list.project_year', $filters['project_year']);
        }

        // Filter berdasarkan status site
        if (!empty($filters['status_site'])) {
            $query->where('implementasi.status_site', $filters['status_site']);
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

        // Filter berdasarkan SMP-ID
        if (!empty($filters['phase_name'])) {
            $query->where('site_list.phase_name', 'like', '%' . $filters['phase_name'] . '%');
        }

        // Filter berdasarkan OA Date
        if (!empty($filters['oa_date'])) {
            $query->where('implementasi.oa_date', 'like', '%' . $filters['oa_date'] . '%');
        }

        // Filter berdasarkan Status OA
        if (!empty($filters['status_oa'])) {
            $query->where('implementasi.status_oa', 'like', '%' . $filters['status_oa'] . '%');
        }

        // Filter berdasarkan Status Task ATP Born
        if (!empty($filters['status_task_atp_born'])) {
            $query->where('doc_acceptance.status_task_atp_born', $filters['status_task_atp_born']);
        }

        // Filter berdasarkan Status Take Data ATP Born
        if (!empty($filters['status_take_data_atp_born'])) {
            $query->where('doc_acceptance.status_take_data_atp_born', $filters['status_take_data_atp_born']);
        }

        // Filter berdasarkan ATP Internal Review Date
        if (!empty($filters['atp_internal_review_date'])) {
            $query->whereDate('doc_acceptance.atp_internal_review_date', $filters['atp_internal_review_date']);
        }

        // Filter berdasarkan PIC ATP Internal Review
        if (!empty($filters['pic_atp_internal_review'])) {
            $query->where('doc_acceptance.pic_atp_internal_review', 'like', '%' . $filters['pic_atp_internal_review'] . '%');
        }

        // Filter berdasarkan Remark
        if (!empty($filters['remark'])) {
            $query->where('doc_acceptance.remark', 'like', '%' . $filters['remark'] . '%');
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('site_list.site_name', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.site_id', 'LIKE', '%' . $search . '%')
                ->orWhere('regional_list.regional', 'LIKE', '%' . $search . '%')
                ->orWhere('regional_list.coa', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.project_year', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.phase_name', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.smp_id', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.system_key', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.area', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.zone', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.phase_group', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.sow', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.status_site', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.oa_date', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.status_oa', 'LIKE', '%' . $search . '%')
                ->orWhere('doc_acceptance.status_task_atp_born', 'LIKE', '%' . $search . '%')
                ->orWhere('doc_acceptance.status_take_data_atp_born', 'LIKE', '%' . $search . '%')
                ->orWhere('doc_acceptance.atp_internal_review_date', 'LIKE', '%' . $search . '%')
                ->orWhere('doc_acceptance.pic_atp_internal_review', 'LIKE', '%' . $search . '%')
                ->orWhere('doc_acceptance.remark', 'LIKE', '%' . $search . '%');
            });
        }

        // Ambil hasil filter dan pagination
        $dataAtpList = $query->distinct()->paginate(10);

        if ($request->ajax()) {
            return view('partials.atp-search-results', compact('dataAtpList'))->render();
        }

        // Untuk permintaan biasa, tampilkan seluruh halaman
        return view('atp.atp', compact('dataAtpList', 'filters'));
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
    public function edit($id_implementasi)
    {
        // Ambil data ATP berdasarkan id_implementasi
        $dataAtpList = Atp::JoinWithSitelistAndImplementasi()->where('doc_acceptance.id_implementasi', $id_implementasi)->firstOrFail();
        
        // Kembalikan view untuk halaman edit
        return view('atp.updateAtp', compact('dataAtpList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_implementasi)
    {
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'status_task_atp_born' => 'required|string',
            'status_take_data_atp_born' => 'required|string',
            'atp_internal_review_date' => 'nullable|date',
            'pic_atp_internal_review' => 'nullable|string',
            'remark' => 'nullable|string',
        ]);

        // Cari data ATP berdasarkan id_implementasi
        $atp = Atp::where('doc_acceptance.id_implementasi', $id_implementasi)->firstOrFail();

        // Update data
        $atp->update([
            'status_task_atp_born' => $validatedData['status_task_atp_born'],
            'status_take_data_atp_born' => $validatedData['status_take_data_atp_born'],
            'atp_internal_review_date' => $validatedData['atp_internal_review_date'],
            'pic_atp_internal_review' => $validatedData['pic_atp_internal_review'],
            'remark' => $validatedData['remark'],
            'last_update' => now(),
        ]);

        // Redirect setelah berhasil update
        return redirect()->route('atp.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
