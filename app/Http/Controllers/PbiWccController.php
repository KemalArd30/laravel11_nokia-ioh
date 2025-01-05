<?php

namespace App\Http\Controllers;

use App\Imports\WCCFullPaymentDataImport;
use App\Imports\WCCPartialPaymentDataImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PbiWccController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wcc.PbiWccImport');
    }

    public function importFullPay(Request $request)
    {
        // Validasi file input
        if (!$request->hasFile('file')) {
            session()->flash('error', 'Silahkan Pilih File yang akan di Import'); // Jika tidak ada file
            return redirect()->back();
        }

        try {
            Excel::import(new WCCFullPaymentDataImport(), $request->file('file'));
    
            // Jika tidak ada error, tampilkan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil diimpor.');
        } catch (\Exception $e) {
            // Tangkap error dan kirimkan pesan error ke view
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    public function importPartialPay(Request $request)
    {
        // Validasi file input
        if (!$request->hasFile('file')) {
            session()->flash('error', 'Silahkan Pilih File yang akan di Import'); // Jika tidak ada file
            return redirect()->back();
        }

        try {
            Excel::import(new WCCPartialPaymentDataImport(), $request->file('file'));
    
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
