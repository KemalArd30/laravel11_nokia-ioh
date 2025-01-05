<?php

namespace App\Http\Controllers;

use App\Imports\PbiProjectImport;
use App\Models\Implementasi;
use App\Models\Sitelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ImplementasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua filter dari request
        $filters = $request->only([
            'project_year', 'status_site', 'regional', 'zone', 
            'area', 'system_key', 'site_id', 'site_name', 'smp_id', 
            'module_id', 'ms13_ready_for_implementation', 'is13_1_main_equipment_is_onsite', 
            'ms15_implementation_starts', 'is15_1_installation_complete', 'is15_4_integration_complete',
            'ms16_implementation_ends', 'ms17_site_acceptance', 'oa_date', 'status_oa', 'remark',
        ]);

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Query awal, join tabel dan ambil data yang diperlukan
        $query = Implementasi::joinWithPbiProject()->distinct();

        // Terapkan filter berdasarkan input dari form
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

        // Filter berdasarkan tanggal MS13
        if (!empty($filters['ms13_ready_for_implementation'])) {
            $query->whereDate('implementasi.ms13_ready_for_implementation', $filters['ms13_ready_for_implementation']);
        }

        // Filter berdasarkan tanggal IS15.1
        if (!empty($filters['is13_1_main_equipment_is_onsite'])) {
            $query->whereDate('implementasi.is15_1_installation_complete', $filters['is13_1_main_equipment_is_onsite']);
        }

        // Filter berdasarkan tanggal IS15.1
        if (!empty($filters['is15_1_installation_complete'])) {
            $query->whereDate('implementasi.is15_1_installation_complete', $filters['is15_1_installation_complete']);
        }

        // Filter berdasarkan tanggal IS15.4
        if (!empty($filters['is15_4_integration_complete'])) {
            $query->whereDate('implementasi.is15_4_integration_complete', $filters['is15_4_integration_complete']);
        }

        // Filter berdasarkan tanggal MS16
        if (!empty($filters['ms16_implementation_ends'])) {
            $query->whereDate('implementasi.ms16_implementation_ends', $filters['ms16_implementation_ends']);
        }

        // Filter berdasarkan tanggal MS17
        if (!empty($filters['ms17_site_acceptance'])) {
            $query->whereDate('implementasi.ms17_site_acceptance', $filters['ms17_site_acceptance']);
        }

        // Filter berdasarkan OA Date
        if (!empty($filters['oa_date'])) {
            $query->whereDate('implementasi.oa_date', $filters['oa_date']);
        }

        // Filter berdasarkan Status OA
        if (!empty($filters['status_oa'])) {
            $query->where('implementasi.status_oa', 'like', '%' . $filters['status_oa'] . '%');
        }

        // Filter berdasarkan Remark
        if (!empty($filters['remark'])) {
            $query->where('implementasi.remark', 'like', '%' . $filters['remark'] . '%');
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('site_list.site_name', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.site_id', 'LIKE', '%' . $search . '%')
                ->orWhere('regional_list.regional', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.project_year', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.phase_name', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.smp_id', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.status_site', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.ms13_ready_for_implementation', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.is13_1_main_equipment_is_onsite', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.ms15_implementation_starts', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.is15_1_installation_complete', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.is15_4_integration_complete', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.ms16_implementation_ends', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.ms17_site_acceptance', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.oa_date', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.status_oa', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.remark', 'LIKE', '%' . $search . '%')
                ->orWhere('implementasi.last_update', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.system_key', 'LIKE', '%' . $search . '%')
                ->orWhere('regional_list.coa', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.area', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.zone', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.phase_group', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.sow', 'LIKE', '%' . $search . '%');
            });
        }

        // Ambil hasil filter dan pagination
        $dataImplementasiList = $query->distinct()->paginate(10);

        // dd($dataImplementasiList); // Debugging untuk melihat isi data

        if ($request->ajax()) {
            return view('partials.onAir-search-results', compact('dataImplementasiList'))->render();
        }

        // Untuk permintaan biasa, tampilkan seluruh halaman
        return view('implementasi.onAir', compact('dataImplementasiList', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('implementasi.pbiProjectImport');
    }


    public function import(Request $request)
    {
        // Validasi file input
        if (!$request->hasFile('file')) {
            session()->flash('error', 'Silahkan Pilih File yang akan di Import'); // Jika tidak ada file
            return redirect()->back();
        }

        try {
            Excel::import(new PbiProjectImport(), $request->file('file'));

            // Setelah import berhasil, update milestones
            $this->updateMilestones();
    
            // Jika tidak ada error, tampilkan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil diimpor.');
        } catch (\Exception $e) {
            // Tangkap error dan kirimkan pesan error ke view
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    public function updateMilestones()
    {
        // Ambil data dari join antara pbi_project, site_list, dan implementasi
        $implementasiList = Implementasi::joinWithPbiProject()->get();

        // Mapping milestone ke kolom implementasi
        $milestoneMapping = [
            'IS13.1' => 'is13_1_main_equipment_is_onsite',
            'MS15' => 'ms15_implementation_starts',
            'IS15.1' => 'is15_1_installation_complete',
            'IS15.4' => 'is15_4_integration_complete',
            'MS16' => 'ms16_implementation_ends',
            'MS17' => 'ms17_site_acceptance',
        ];

        // Loop untuk update tabel implementasi berdasarkan data join
    foreach ($implementasiList as $data) {
        // Dapatkan id_sitelist dari site_list berdasarkan smp_id
        $idSitelist = Sitelist::where('smp_id', $data->smp_id)->value('id_sitelist');

        // Cek apakah milestone ini ada di mapping
        if (isset($milestoneMapping[$data->milestone_and_inchstone])) {
            // Update kolom yang sesuai di tabel implementasi
            Implementasi::where('id_sitelist', $idSitelist) // Menggunakan id_sitelist
                ->update([
                    $milestoneMapping[$data->milestone_and_inchstone] => $data->actual_end_date,
                ]);
        }
        }
    }

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
    public function edit(string $id_implementasi)
    {
        // Ambil data Implementasi berdasarkan id_implementasi
        $dataImplementasiList = Implementasi::joinWithPbiProject()->where('implementasi.id_implementasi', $id_implementasi)->firstOrFail();
        
        // Kembalikan view untuk halaman edit
        return view('implementasi.updateOnAir', compact('dataImplementasiList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_implementasi)
    {
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'oa_date' => 'required|date',
            'status_oa' => 'required|string',
            'remark' => 'nullable|string',
        ]);

        // Cari data Implementasi berdasarkan id_implementasi
        $oa = Implementasi::where('implementasi.id_implementasi', $id_implementasi)->firstOrFail();

        // Update data
        $oa->update([
            'oa_date' => $validatedData['oa_date'],
            'status_oa' => $validatedData['status_oa'],
            'remark' => $validatedData['remark'],
            'last_update' => now(),
        ]);

        // Redirect setelah berhasil update
        return redirect()->route('implementasi.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
