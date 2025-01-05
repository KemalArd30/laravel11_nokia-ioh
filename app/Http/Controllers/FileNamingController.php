<?php

namespace App\Http\Controllers;

use App\Exports\FileNamingExport;
use App\Imports\FileNamingImport;
use App\Models\FileNaming;
use App\Models\Sitelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class FileNamingController extends Controller
{   
    /**
    * Display a listing of the resource.
    */
    public function index(Request $request)
    {   
        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Mulai query dari FileNaming yang sudah terkait dengan Sitelist
        $query = FileNaming::withSitelist();

        // Terapkan filter berdasarkan input dari form
        if ($user && !$user->hasRole('admin') && $user->regional !== 'HEAD OFFICE' && $user->regional) {
            $query->where('regional_list.regional', $user->regional);
        }

        if ($request->filled('region')) {
            $query->where('regional_list.regional', 'like', '%' . $request->region . '%');
        }

        if ($request->filled('systemKey')) {
            $query->where('site_list.system_key', 'like', '%' . $request->systemKey . '%');
        }

        if ($request->filled('siteID')) {
            $query->where('site_list.site_id', 'like', '%' . $request->siteID . '%');
        }

        if ($request->filled('siteName')) {
            $query->where('site_list.site_name', 'like', '%' . $request->siteName . '%');
        }

        if ($request->filled('phaseName')) {
            $query->where('site_list.phase_name', 'like', '%' . $request->phaseName . '%');
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('regional_list.regional', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.system_key', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.site_id', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.site_name', 'LIKE', '%' . $search . '%')
                ->orWhere('site_list.phase_name', 'LIKE', '%' . $search . '%');
            });
        }


        // Jalankan query dan dapatkan hasilnya
        $dataFileNaming = $query->paginate(10);

        // Jika ini permintaan AJAX, hanya kembalikan data tabel yang terfilter
        if ($request->ajax()) {
            return view('partials.naming-search-results', compact('dataFileNaming'))->render();
        }

        // Kembalikan ke view dengan data yang difilter
        return view('fileNaming.namingList', compact('dataFileNaming'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fileNaming.addFileNaming');
    }

    /**
     * Handle file import and validation.
     */
    public function import(Request $request)
    {
        try {
            // Validasi input file
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);

            // Import file
            $import = new FileNamingImport();
            Excel::import($import, $request->file('file'));

            // Ambil data yang tidak ditemukan
            $unfoundRecords = $import->getUnfoundRecords();
            $errors = $import->getErrors();

            // Tangani data tidak ditemukan
            if (!empty($unfoundRecords)) {
                $unfoundMessage = 'Sitelist tidak ada di database, silahkan hubungi Superadmin: ' . PHP_EOL .
                    implode(PHP_EOL, array_map(function($record) {
                        return $record['system_key'] . ' ' . $record['site_id'] . ' ' . $record['site_name'];
                    }, $unfoundRecords));
                Log::error($unfoundMessage);
                session()->flash('error', $unfoundMessage);
            }

            // Tangani error yang sudah ada
            if (!empty($errors)) {
                $errorMessage = 'File naming sudah ada, silahkan update manual untuk perubahan: ' . PHP_EOL .
                implode(PHP_EOL, $errors);
                Log::error($errorMessage);
                session()->flash('error', $errorMessage);
            }

            // Tampilkan pesan sukses jika tidak ada error
            if (empty($unfoundRecords) && empty($errors)) {
                session()->flash('success', 'Berhasil Import Data.');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error during import: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_sitelist)
    {
        // Lakukan query dengan join dan seleksi kolom
        $dataFileNaming = FileNaming::withSitelist()
            ->leftJoin('regional_list', 'site_list.coa', '=', 'regional_list.coa')
            ->select('file_naming.*', 'site_list.system_key', 'site_list.site_id', 'site_list.site_name', 'site_list.phase_name', 'regional_list.regional')
            ->where('file_naming.id_sitelist', $id_sitelist)
            ->firstOrFail();  // Untuk mengambil satu data berdasarkan id_sitelist

        // Kirim hasil query ke view dengan nama variabel $dataFileNaming
        return view('fileNaming.editNaming', compact('dataFileNaming'));
    }

    public function update(Request $request, $id_sitelist)
    {
        // dd($request->all());
        $request->validate([
            'tssrFileNaming' => 'required|string|max:255',
            'sidFileNaming' => 'required|string|max:255',
            'netgearMosFileNaming' => 'required|string|max:255',
            'lldFileNaming' => 'required|string|max:255',
            'abdwFileNaming' => 'required|string|max:255',
            'abdnFileNaming' => 'required|string|max:255',
            'boqFileNaming' => 'required|string|max:255',
            'atfFileNaming' => 'required|string|max:255',
            'atpFileNaming' => 'required|string|max:255',
        ], [
            'tssrFileNaming.required' => 'Wajib diisi',
            'sidFileNaming.required' => 'Wajib diisi',
            'netgearMosFileNaming.required' => 'Wajib diisi',
            'lldFileNaming.required' => 'Wajib diisi',
            'abdwFileNaming.required' => 'Wajib diisi',
            'abdnFileNaming.required' => 'Wajib diisi',
            'boqFileNaming.required' => 'Wajib diisi',
            'atfFileNaming.required' => 'Wajib diisi',
            'atpFileNaming.required' => 'Wajib diisi',
        ]);

        $filenaming = FileNaming::findOrFail($id_sitelist);

        $filenaming->update([
            'tssr_file_naming' => $request->tssrFileNaming,
            'sid_file_naming' => $request->sidFileNaming,
            'netgear_mos_file_naming' => $request->netgearMosFileNaming,
            'lld_file_naming' => $request->lldFileNaming,
            'abdw_file_naming' => $request->abdwFileNaming,
            'abdn_file_naming' => $request->abdnFileNaming,
            'boq_file_naming' => $request->boqFileNaming,
            'atf_file_naming' => $request->atfFileNaming,
            'atp_file_naming' => $request->atpFileNaming,
            'last_update' => now(),
        ]);

        return redirect()->route('filenaming.index')->with('success', 'Naming berhasil diperbarui.');
    }

    public function export()
    {
        return Excel::download(new FileNamingExport, 'File Naming.xlsx');
    }
}