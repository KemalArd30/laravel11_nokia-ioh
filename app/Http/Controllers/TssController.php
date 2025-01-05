<?php

namespace App\Http\Controllers;

use App\Exports\TssExport;
use App\Imports\PbiTssImport;
use App\Models\Tss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class TssController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua filter dari request
        $filters = $request->only([
            'projectYear', 'statusSite', 'region', 'zone', 
            'area', 'systemKey', 'siteID', 'siteName', 'smpID', 
            'moduleID', 'scmAssignedToFST', 'fillTssChecklistComplete', 
            'reviewBySCM', 'reviewByPE', 'tssApprovedDate', 'uploadDateTssrPpm'
        ]);

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Query awal, join tabel dan ambil data yang diperlukan
        $query = Tss::joinWithPbiTss();

        // Terapkan filter berdasarkan input dari form
        if ($user && !$user->hasRole('admin') && $user->regional !== 'HEAD OFFICE' && $user->regional) {
            $query->where('regional_list.regional', $user->regional);
        }

        // Filter berdasarkan project year
        if (!empty($filters['projectYear'])) {
            $query->where('site_list.project_year', $filters['projectYear'])->withQueryString();
        }

        // Filter berdasarkan status site
        if (!empty($filters['statusSite'])) {
            $query->where('tss.status_site', $filters['statusSite']);
        }

        // Filter berdasarkan region
        if (!empty($filters['region'])) {
            $query->where('regional_list.regional', 'like', '%' . $filters['region'] . '%');
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
        if (!empty($filters['systemKey'])) {
            $query->where('site_list.system_key', 'like', '%' . $filters['systemKey'] . '%');
        }

        // Filter berdasarkan site ID
        if (!empty($filters['siteID'])) {
            $query->where('site_list.site_id', 'like', '%' . $filters['siteID'] . '%');
        }

        // Filter berdasarkan site name
        if (!empty($filters['siteName'])) {
            $query->where('site_list.site_name', 'like', '%' . $filters['siteName'] . '%');
        }

        // Filter berdasarkan SMP-ID
        if (!empty($filters['smpID'])) {
            $query->where('pbi_tss.smp_id', 'like', '%' . $filters['smpID'] . '%');
        }

        // Filter berdasarkan Module ID
        if (!empty($filters['moduleID'])) {
            $query->where('pbi_tss.module_id', 'like', '%' . $filters['moduleID'] . '%');
        }

        // Filter berdasarkan tanggal SCM Assigned to FST
        if (!empty($filters['scmAssignedToFST'])) {
            $query->whereDate('pbi_tss.scm_assigned_to_fst', $filters['scmAssignedToFST']);
        }

        // Filter berdasarkan tanggal Fill TSS Checklist Complete
        if (!empty($filters['fillTssChecklistComplete'])) {
            $query->whereDate('pbi_tss.fill_tss_checklist_complete', $filters['fillTssChecklistComplete']);
        }

        // Filter berdasarkan tanggal Review by SCM
        if (!empty($filters['reviewBySCM'])) {
            $query->whereDate('pbi_tss.review_by_scm', $filters['reviewBySCM']);
        }

        // Filter berdasarkan tanggal Review by PE
        if (!empty($filters['reviewByPE'])) {
            $query->whereDate('pbi_tss.review_by_pe', $filters['reviewByPE']);
        }

        // Filter berdasarkan TSS Approved Date
        if (!empty($filters['tssApprovedDate'])) {
            $query->whereDate('pbi_tss.tssr_done', $filters['tssApprovedDate']);
        }

        // Filter berdasarkan Upload Date TSSR PPM
        if (!empty($filters['uploadDateTssrPpm'])) {
            $query->whereDate('tss.upload_date_tssr_ppm', $filters['uploadDateTssrPpm']);
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
                ->orWhere('pbi_tss.module_id', 'LIKE', '%' . $search . '%')
                ->orWhere('tss.status_site', 'LIKE', '%' . $search . '%')
                ->orWhere('pbi_tss.scm_assigned_to_fst', 'LIKE', '%' . $search . '%')
                ->orWhere('pbi_tss.fill_tss_checklist_complete', 'LIKE', '%' . $search . '%')
                ->orWhere('pbi_tss.review_by_scm', 'LIKE', '%' . $search . '%')
                ->orWhere('pbi_tss.review_by_pe', 'LIKE', '%' . $search . '%')
                ->orWhere('pbi_tss.tssr_done', 'LIKE', '%' . $search . '%')
                ->orWhere('pbi_tss.aging_survey_to_tss_submit', 'LIKE', '%' . $search . '%')
                ->orWhere('pbi_tss.total_aging_tss', 'LIKE', '%' . $search . '%')
                ->orWhere('tss.upload_date_tssr_ppm', 'LIKE', '%' . $search . '%')
                ->orWhere('tss.url_tssr_ppm', 'LIKE', '%' . $search . '%')
                ->orWhere('tss.remark', 'LIKE', '%' . $search . '%')
                ->orWhere('tss.last_update', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.system_key', 'LIKE', '%' . $search . '%')
                ->orWhere('regional_list.coa', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.area', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.zone', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.phase_group', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.sow', 'LIKE', '%' . $search . '%');
            });
        }

        // Ambil hasil filter dan pagination
        $dataTssList = $query->paginate(10);
        // dd($dataTssList); // Debugging untuk melihat isi data

        // Jika ini permintaan AJAX, hanya kembalikan data tabel yang terfilter
        if ($request->ajax()) {
            return view('partials.tss-search-results', compact('dataTssList'))->render();
        }

        // Untuk permintaan biasa, tampilkan seluruh halaman
        return view('tss.tssList', compact('dataTssList', 'filters'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tss.PbiTssImport');
    }

    public function import(Request $request)
    {
        // Validasi file input
        if (!$request->hasFile('file')) {
            session()->flash('error', 'Silahkan Pilih File yang akan di Import'); // Jika tidak ada file
            return redirect()->back();
        }

        try {
            Excel::import(new PbiTssImport(), $request->file('file'));
    
            // Jika tidak ada error, tampilkan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil diimpor.');
        } catch (\Exception $e) {
            // Tangkap error dan kirimkan pesan error ke view
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
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
    public function edit($id_tss)
    {
        // dd($id_tss);
        // Ambil data TSS berdasarkan id_tss
        $dataTssList = Tss::joinWithPbiTss()->where('tss.id_tss', $id_tss)->firstOrFail();
        
        // Kembalikan view untuk halaman edit
        return view('tss.editTss', compact('dataTssList'));
    }

    public function update(Request $request, $id_tss)
    {
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'urlTssrPpm' => 'required|url',
            'remark' => 'nullable|string',
        ]);

        // Cari data TSS berdasarkan id_tss
        $tss = Tss::where('tss.id_tss', $id_tss)->firstOrFail();

        // Update data
        $tss->update([
            'url_tssr_ppm' => $validatedData['urlTssrPpm'],
            'remark' => $validatedData['remark'],
            'upload_date_tssr_ppm' => now(),
            'last_update' => now(),
        ]);

        // Redirect setelah berhasil update
        return redirect()->route('tss.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export()
    {
        return Excel::download(new TssExport, 'tss.xlsx');
    }
}
