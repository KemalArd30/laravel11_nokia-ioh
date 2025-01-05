<?php

namespace App\Imports;

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
use App\Models\WccFullPayment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SitelistImport implements ToModel, WithHeadingRow
{
    use Importable;

    private $errors = [];

    public function model(array $row)
    {
        // Validasi jika `system_key` sudah ada
        $existing = Sitelist::where('system_key', $row['system_key'])->first();

        if ($existing) {
            // Simpan pesan error
            $this->errors[] = 'System Key Sudah Ada : ' . $row['system_key'];
            return null;
        }

        // Format tanggal untuk ID Sitelist
        $dateCreated = Carbon::now()->format('dmY'); // Menggunakan format 'DDMMYYYY'

        // Generate ID Sitelist
        $sitelistId = Sitelist::generateSitelistId($dateCreated);

        // Buat dan simpan instance model Sitelist
        $sitelist = new Sitelist([
            'id_sitelist' => $sitelistId,
            'project_year' => $row['project_year'],
            'main_project' => $row['main_project'],
            'coa' => $row['coa'],
            'area' => $row['area'],
            'zone' => $row['zone'],
            'site_id' => $row['site_id'],
            'site_name' => $row['site_name'],
            'system_key' => $row['system_key'],
            'smp_id' => $row['smp_id'],
            'phase_name' => $row['phase_name'],
            'phase_group' => $row['phase_group'],
            'sow' => $row['sow'],
            'sow_detail' => $row['sow_detail'],
            'category_scope' => $row['category_scope'],
        ]);

        $sitelist->save();

        // Jika category_scope adalah 'TI', tambahkan ke tabel tss dan implementasi
        if ($row['category_scope'] === 'TI') {
            // Generate ID untuk tabel tss
            $tssId = str_replace('_NSN_IOH_', '_NSN_IOH_TSS_', $sitelistId);

            // Simpan data ke tabel tss
            Tss::create([
                'id_sitelist' => $sitelistId,
                'id_tss' => $tssId,
                'status_site' => 'ACTIVE',
                // tambahkan kolom lain yang diperlukan untuk tabel tss
            ]);

            // Simpan data ke tabel tss
            WccFullPayment::create([
                'id_sitelist' => $sitelistId,
                'id_scope' => $tssId,
                'status_site' => 'ACTIVE',
                // tambahkan kolom lain yang diperlukan untuk tabel tss
            ]);

            // Generate ID untuk tabel implementasi
            $implementasiId = str_replace('_NSN_IOH_', '_NSN_IOH_IMPL_', $sitelistId);

            // Simpan data ke tabel implementasi
            Implementasi::create([
                'id_sitelist' => $sitelistId,
                'id_implementasi' => $implementasiId,
                'system_key' => $row['system_key'],
                'status_site' => 'ACTIVE',
                // tambahkan kolom lain yang diperlukan untuk tabel implementasi
            ]);

            // Simpan data ke tabel file_naming
            FileNaming::create([
                'id_sitelist' => $sitelistId,
                'system_key' => $row['system_key'],
                // tambahkan kolom lain yang diperlukan untuk tabel file_naming
            ]);

            // Simpan data ke tabel netgear_mos
            NetgearMos::create([
                'id_sitelist' => $sitelistId,
                'id_implementasi' => $implementasiId,
                // tambahkan kolom lain yang diperlukan untuk tabel netgear_mos
            ]);

            // Simpan data ke tabel doc_lld
            LldNdb::create([
                'id_sitelist' => $sitelistId,
                'id_implementasi' => $implementasiId,
                // tambahkan kolom lain yang diperlukan untuk tabel doc_lld
            ]);

            // Simpan data ke tabel doc_abd
            Abd::create([
                'id_sitelist' => $sitelistId,
                'id_implementasi' => $implementasiId,
                // tambahkan kolom lain yang diperlukan untuk tabel doc_abd
            ]);

            // Simpan data ke tabel doc_boq
            Boq::create([
                'id_sitelist' => $sitelistId,
                'id_implementasi' => $implementasiId,
                // tambahkan kolom lain yang diperlukan untuk tabel doc_boq
            ]);

            // Simpan data ke tabel doc_atf
            NetgearAtf::create([
                'id_sitelist' => $sitelistId,
                'id_implementasi' => $implementasiId,
                // tambahkan kolom lain yang diperlukan untuk tabel doc_atf
            ]);

            // Simpan data ke tabel doc_acceptance
            Atp::create([
                'id_sitelist' => $sitelistId,
                'id_implementasi' => $implementasiId,
                // tambahkan kolom lain yang diperlukan untuk tabel doc_atf
            ]);

            // Simpan data ke tabel doc_acceptance
            WccFullPayment::create([
                'id_sitelist' => $sitelistId,
                'id_scope' => $implementasiId,
                // tambahkan kolom lain yang diperlukan untuk tabel doc_atf
            ]);
        }

        return $sitelist;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}