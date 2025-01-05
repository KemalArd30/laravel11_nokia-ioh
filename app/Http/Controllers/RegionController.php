<?php

namespace App\Http\Controllers;

use App\Exports\RegionExport;
use App\Models\Region;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'coa', 'project', 'region'
        ]);

        // Membuat query dasar
        $query = Region::query();

        // Menambahkan kondisi pencarian berdasarkan input
        if (!empty($filters['coa'])) {
            $query->where('coa', $filters['coa']);
        }

        if (!empty($filters['project'])) {
            $query->where('project', $filters['project']);
        }

        if (!empty($filters['region'])) {
            $query->where('regional', $filters['region']);
        }

        // Memastikan pencarian di luar filter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('coa', 'LIKE', '%' . $search . '%')
                    ->orWhere('project', 'LIKE', '%' . $search . '%')
                    ->orWhere('regional', 'LIKE', '%' . $search . '%');
            });
        }

        // Menjalankan query dan mendapatkan hasil
        $regions = $query->paginate(10);

        // Jika ini permintaan AJAX, hanya kembalikan data tabel yang terfilter
        if ($request->ajax()) {
            return view('partials.region-search-results', compact('regions'))->render();
        }

        // Tampilkan halaman dengan hasil pencarian atau data filter
        return view('region.regionList', compact('regions', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('region.addRegion');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coa' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'region' => 'required|string|max:255', // Sesuaikan dengan nama kolom yang benar
        ], [
            'coa.required' => 'COA wajib diisi',
            'project.required' => 'Project wajib diisi',
            'region.required' => 'Regional wajib diisi',
        ]);

        $dataRegion = [
            'coa' => $request->coa,
            'project' => $request->project,
            'regional' => $request->region, // Sesuaikan dengan nama kolom yang benar
        ];

        Region::create($dataRegion);
        return redirect()->route('region.index')->with('success', 'Regional berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($coa)
    {
        $region = Region::findOrFail($coa);
        return view('region.editRegion', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $coa)
    {
        $request->validate([
            'coa' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'region' => 'required|string|max:255', // Sesuaikan dengan nama kolom yang benar
        ], [
            'coa.required' => 'COA wajib diisi',
            'project.required' => 'Project wajib diisi',
            'region.required' => 'Regional wajib diisi',
        ]);

        $region = Region::findOrFail($coa);

        $region->update([
            'coa' => $request->coa,
            'project' => $request->project,
            'regional' => $request->region, // Sesuaikan dengan nama kolom yang benar
            'last_update' => now(),
        ]);

        return redirect()->route('region.index')->with('success', 'Regional berhasil diperbarui.');
    }

    public function getData()
    {
        $regions = Region::all();
        return response()->json($regions);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($coa)
    {
        $region = Region::findOrFail($coa);
        $region->delete();
        return redirect()->route('region.index')->with('success', 'Regional berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            Region::whereIn('coa', $ids)->delete();
            return redirect()->back()->with('success', 'Selected regions deleted successfully.');
        }

        return redirect()->back()->with('error', 'No regions selected.');
    }

    public function export()
    {
        return Excel::download(new RegionExport, 'region.xlsx');
    }
}