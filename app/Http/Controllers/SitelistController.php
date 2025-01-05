<?php

namespace App\Http\Controllers;

use App\Exports\SiteListExport;
use App\Imports\SitelistImport;
use App\Models\Abd;
use App\Models\Atp;
use App\Models\Boq;
use App\Models\FileNaming;
use App\Models\Implementasi;
use App\Models\LldNdb;
use App\Models\NetgearAtf;
use App\Models\NetgearMos;
use App\Models\Sitelist;
use App\Models\Tss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SitelistController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Mulai query dengan relasi Region
        $query = Sitelist::withRegion();

    // Batasi hasil berdasarkan region pengguna yang login
        if ($user && !$user->hasRole('admin') && $user->regional !== 'HEAD OFFICE' && $user->regional) {
            $query->where('regional_list.regional', $user->regional);
        }

        // Terapkan filter berdasarkan input dari form
        if ($request->filled('projectYear')) {
            $query->where('project_year', $request->projectYear);
        }

        if ($request->filled('statusSite')) {
            $query->where('status_site', $request->statusSite);
        }

        if ($request->filled('coa')) {
            $query->where('regional_list.coa', 'like', '%' . $request->coa . '%');
        }

        if ($request->filled('zone')) {
            $query->where('zone', 'like', '%' . $request->zone . '%');
        }

        if ($request->filled('region')) {
            $query->where('regional', 'like', '%' . $request->region . '%');
        }

        if ($request->filled('area')) {
            $query->where('area', 'like', '%' . $request->area . '%');
        }

        if ($request->filled('systemKey')) {
            $query->where('system_key', 'like', '%' . $request->systemKey . '%');
        }

        if ($request->filled('smpID')) {
            $query->where('smp_id', 'like', '%' . $request->smpID . '%');
        }

        if ($request->filled('siteID')) {
            $query->where('site_id', 'like', '%' . $request->siteID . '%');
        }

        if ($request->filled('siteName')) {
            $query->where('site_name', 'like', '%' . $request->siteName . '%');
        }

        if ($request->filled('phaseName')) {
            $query->where('phase_name', 'like', '%' . $request->phaseName . '%');
        }

        if ($request->filled('sow')) {
            $query->where('sow', 'like', '%' . $request->sow . '%');
        }

        if ($request->filled('sowDetail')) {
            $query->where('sow_detail', 'like', '%' . $request->sowDetail . '%');
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('project_year', 'LIKE', '%' . $search . '%')
                ->orWhere('status_site', 'LIKE', '%' . $search . '%')
                ->orWhere('regional_list.coa', 'LIKE', '%' . $search . '%')
                ->orWhere('zone', 'LIKE', '%' . $search . '%')
                ->orWhere('regional', 'LIKE', '%' . $search . '%')
                ->orWhere('area', 'LIKE', '%' . $search . '%')
                ->orWhere('system_key', 'LIKE', '%' . $search . '%')
                ->orWhere('smp_id', 'LIKE', '%' . $search . '%')
                ->orWhere('site_id', 'LIKE', '%' . $search . '%')
                ->orWhere('site_name', 'LIKE', '%' . $search . '%')
                ->orWhere('phase_name', 'LIKE', '%' . $search . '%')
                ->orWhere('sow', 'LIKE', '%' . $search . '%')
                ->orWhere('sow_detail', 'LIKE', '%' . $search . '%');
            });
        }
                

        // Jalankan query dan dapatkan hasilnya
        $dataSitelist = $query->paginate(10);

        // Jika ini permintaan AJAX, hanya kembalikan data tabel yang terfilter
        if ($request->ajax()) {
            return view('partials.sitelist-search-results', compact('dataSitelist'))->render();
        }

        // Kembalikan ke view dengan data yang difilter
        return view('site.siteList', compact('dataSitelist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('site.addSite');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
    
        try {
            $import = new SitelistImport();
            Excel::import($import, $request->file('file')->store('temp'));

            // Ambil pesan error
            $errors = $import->getErrors();

            if (!empty($errors)) {
                return redirect()->route('sitelist.create')->withErrors(['import' => $errors]);
            }

            return redirect()->route('sitelist.create')->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return redirect()->route('sitelist.create')->withErrors(['file' => 'Failed to import data: ' . $e->getMessage()]);
        }
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
    public function edit(string $id_sitelist)
    {
        $sitelist = Sitelist::findOrFail($id_sitelist);
        return view('site.editSite', compact('sitelist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_sitelist)
    {
        // dd($request->all());
        $request->validate([
            'projectYear' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
            'systemKey' => 'required|string|max:255',
            'smpId' => 'required|string|max:255',
            'siteId' => 'required|string|max:255',
            'siteName' => 'required|string|max:255',
            'statusSite' => 'required|string|max:255',
            'phaseName' => 'required|string|max:255',
            'phaseGroup' => 'required|string|max:255',
            'sow' => 'required|string|max:255',
            'sowDetail' => 'required|string|max:255',
        ], [
            'projectYear.required' => 'Project Year wajib diisi',
            'area.required' => 'Area wajib diisi',
            'zone.required' => 'Zone wajib diisi',
            'systemKey.required' => 'System Key wajib diisi',
            'smpId.required' => 'SMP-ID wajib diisi',
            'siteId.required' => 'Site ID wajib diisi',
            'siteName.required' => 'Site Name wajib diisi',
            'statusSite.required' => 'Status Site wajib diisi',
            'phaseName.required' => 'Phase Name wajib diisi',
            'phaseGroup.required' => 'Phase Group wajib diisi',
            'sow.required' => 'SOW wajib diisi',
            'sowDetail.required' => 'SOW Detail wajib diisi',
        ]);

        $sitelist = Sitelist::findOrFail($id_sitelist);

        $sitelist->update([
            'project_year' => $request->projectYear,
            'area' => $request->area,
            'zone' => $request->zone,
            'system_key' => $request->systemKey,
            'smp_id' => $request->smpId,
            'site_id' => $request->siteId,
            'site_name' => $request->siteName,
            'status_site' => $request->statusSite,
            'phase_name' => $request->phaseName,
            'phase_group' => $request->phaseGroup,
            'sow' => $request->sow,
            'sow_detail' => $request->sowDetail,
            'remark' => $request->remark,
            'last_update' => now(),
        ]);

        return redirect()->route('sitelist.index')->with('success', 'Site berhasil diperbarui.');
    }

    public function getData()
    {
        $sitelist = Sitelist::all();
        return response()->json($sitelist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_sitelist)
    {
        Log::info('Delete requested for id_sitelist: ' . $id_sitelist);

        // Hapus data dari tabel sitelist
        $sitelist = Sitelist::findOrFail($id_sitelist);
        $sitelist->delete();

        // Hapus data dari tabel tss
        Tss::where('id_sitelist', $id_sitelist)->delete();

        // Hapus data dari tabel implementasi
        Implementasi::where('id_sitelist', $id_sitelist)->delete();

        // Hapus data dari tabel file_naming
        FileNaming::where('id_sitelist', $id_sitelist)->delete();

        // Hapus data dari tabel netgear_mos
        NetgearMos::where('id_sitelist', $id_sitelist)->delete();

        // Hapus data dari tabel doc_lld
        LldNdb::where('id_sitelist', $id_sitelist)->delete();

        // Hapus data dari tabel doc_abd
        Abd::where('id_sitelist', $id_sitelist)->delete();

        // Hapus data dari tabel doc_boq
        Boq::where('id_sitelist', $id_sitelist)->delete();

        // Hapus data dari tabel netgear_atf
        NetgearAtf::where('id_sitelist', $id_sitelist)->delete();

        return redirect()->route('sitelist.index')->with('success', 'Site berhasil dihapus.');
    }


    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        Log::info('Bulk delete requested with IDs: ', $ids);

        if (!empty($ids)) {
            // Hapus data dari tabel sitelist
            Sitelist::whereIn('id_sitelist', $ids)->delete();

            // Hapus data dari tabel tss
            Tss::whereIn('id_sitelist', $ids)->delete();

            // Hapus data dari tabel implementasi
            Implementasi::whereIn('id_sitelist', $ids)->delete();

            // Hapus data dari tabel file_naming
            FileNaming::whereIn('id_sitelist', $ids)->delete();

            // Hapus data dari tabel netgear_mos
            NetgearMos::whereIn('id_sitelist', $ids)->delete();

            // Hapus data dari tabel doc_lld
            LldNdb::whereIn('id_sitelist', $ids)->delete();

            // Hapus data dari tabel doc_abd
            Abd::whereIn('id_sitelist', $ids)->delete();

            // Hapus data dari tabel doc_boq
            Boq::whereIn('id_sitelist', $ids)->delete();

            // Hapus data dari tabel netgear_atf
            NetgearAtf::whereIn('id_sitelist', $ids)->delete();

            // Hapus data dari tabel atp
            Atp::whereIn('id_sitelist', $ids)->delete();

            return redirect()->back()->with('success', 'Selected items deleted successfully.');
        }

        return redirect()->back()->with('error', 'No items selected.');
    }

    public function export()
    {
        return Excel::download(new SiteListExport, 'sitelist.xlsx');
    }

}
