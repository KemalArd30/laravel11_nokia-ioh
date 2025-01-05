<?php

namespace App\Http\Controllers;

use App\Models\Boq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua filter dari request
        $filters = $request->only([
            'project_year', 'status_site', 'regional', 'zone', 
            'area', 'system_key', 'site_id', 'site_name', 'smp_id', 'phase_name', 
            'oa_date', 'status_oa', 'upload_date_boq_ppm', 'remark',
        ]);

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Query awal, join tabel dan ambil data yang diperlukan
        $query = Boq::WithSitelistAndImplementasi()->distinct();

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
            $query->whereDate('implementasi.oa_date', $filters['oa_date']);
        }

        // Filter berdasarkan Status OA
        if (!empty($filters['status_oa'])) {
            $query->where('implementasi.status_oa', 'like', '%' . $filters['status_oa'] . '%');
        }

        // Filter berdasarkan Upload Date BOQ PPM
        if (!empty($filters['upload_date_boq_ppm'])) {
            $query->whereDate('doc_boq.upload_date_boq_ppm', $filters['upload_date_boq_ppm']);
        }

        // Filter berdasarkan Remark
        if (!empty($filters['remark'])) {
            $query->where('doc_boq.remark', 'like', '%' . $filters['remark'] . '%');
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
                ->orWhere('doc_boq.upload_date_boq_ppm', 'LIKE', '%' . $search . '%')
                ->orWhere('doc_boq.remark', 'LIKE', '%' . $search . '%');
            });
        }

        // Ambil hasil filter dan pagination
        $dataBoqList = $query->distinct()->paginate(10);

        if ($request->ajax()) {
            return view('partials.boq-search-results', compact('dataBoqList'))->render();
        }

        // Untuk permintaan biasa, tampilkan seluruh halaman
        return view('boq.boq', compact('dataBoqList', 'filters'));
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
        // Ambil data BOQ berdasarkan id_implementasi
        $dataBoqList = Boq::WithSitelistAndImplementasi()->where('doc_boq.id_implementasi', $id_implementasi)->firstOrFail();
        
        // Kembalikan view untuk halaman edit
        return view('boq.updateBoq', compact('dataBoqList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_implementasi)
    {
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'url_boq_ppm' => 'required|string',
            'remark' => 'nullable|string',
        ]);

        // Cari data BOQ berdasarkan id_implementasi
        $boq = Boq::where('doc_boq.id_implementasi', $id_implementasi)->firstOrFail();

        // Update data
        $boq->update([
            'url_boq_ppm' => $validatedData['url_boq_ppm'],
            'remark' => $validatedData['remark'],
            'upload_date_boq_ppm' => now(),
            'last_update' => now(),
        ]);

        // Redirect setelah berhasil update
        return redirect()->route('boq.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
