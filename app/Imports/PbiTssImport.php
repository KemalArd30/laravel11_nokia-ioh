<?php

namespace App\Imports;

use App\Models\PbiTss;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PbiTssImport implements ToModel, WithHeadingRow, WithChunkReading
{
    protected $rows = []; // Menampung data untuk batch insert
    protected $batchSize = 500; // Ukuran batch untuk batch insert
    private $expectedColumns = [ // Daftar kolom yang diharapkan
        'customer_name', 
        'project_name', 
        'po_number', 
        'p_scopes_ranmwcmeps', 
        'cluster_province', 
        'region', 
        'implementation_vendor', 
        'site_id', 
        'site_name', 
        'module_id', 
        'module_name', 
        'smp_id', 
        'smp_name', 
        'nokia_assign_to_scm', 
        'scm_assign_to_hs_manager', 
        'scm_assigned_to_fst', 
        'fill_tss_checklist_1_done', 
        'fill_tss_checklist_2_done', 
        'fill_tss_checklist_complete', 
        'review_by_scm', 
        'review_by_pe', 
        'tssr_done'
    ];

    public function __construct()
    {
        // Hapus semua data dari tabel sebelum impor, menggunakan TRUNCATE untuk efisiensi
        DB::statement('TRUNCATE TABLE pbi_tss');
        Log::info('All previous data deleted from pbi_tss table.');
    }

    // Fungsi ini hanya perlu dijalankan sekali pada baris pertama
    private function validateHeader(array $row)
    {
        $headers = array_keys($row);

        foreach ($this->expectedColumns as $expectedColumn) {
            if (!in_array($expectedColumn, $headers)) {
                throw new \Exception("Kolom '{$expectedColumn}' tidak ditemukan dalam file.");
            }
        }

        foreach ($headers as $header) {
            if (!in_array($header, $this->expectedColumns)) {
                throw new \Exception("Kolom '{$header}' tidak diizinkan dalam file.");
            }
        }
    }

    private function convertDate($excelDate)
    {
        if (is_numeric($excelDate)) {
            $dateTime = Date::excelToDateTimeObject($excelDate);
            return $dateTime->format('Y-m-d');
        }

        $dateTime = \DateTime::createFromFormat('m/d/Y h:i:s A', $excelDate);
        if ($dateTime) {
            return $dateTime->format('Y-m-d');
        }

        return $excelDate;
    }

    private function getRowValue($row, $key) {
        return isset($row[$key]) ? $row[$key] : null;
    }

    public function model(array $row)
    {
        try {
            // Validasi header pada baris pertama saja
            static $validated = false;
            if (!$validated) {
                $this->validateHeader($row);
                $validated = true;
            }

            $implementationVendor = $this->getRowValue($row, 'implementation_vendor');

            // Hanya memproses baris yang memiliki implementation_vendor "PT INTISEL PRODAKTIFAKOM"
            if ($implementationVendor !== 'PT INTISEL PRODAKTIFAKOM') {
                Log::info('Skipping row with implementation_vendor: ' . $implementationVendor);
                return null;
            }

            // Konversi tanggal
            $scmAssignedToFst = $this->convertDate($this->getRowValue($row, 'scm_assigned_to_fst'));
            $reviewByScm = $this->convertDate($this->getRowValue($row, 'review_by_scm'));
            $tssrDone = $this->convertDate($this->getRowValue($row, 'tssr_done'));
            $nokiaAssignToScm = $this->convertDate($this->getRowValue($row, 'nokia_assign_to_scm'));
            $scmAssignToHsManager = $this->convertDate($this->getRowValue($row, 'scm_assign_to_hs_manager'));
            $fillTssChecklist1Done = $this->convertDate($this->getRowValue($row, 'fill_tss_checklist_1_done'));
            $fillTssChecklist2Done = $this->convertDate($this->getRowValue($row, 'fill_tss_checklist_2_done'));
            $fillTssChecklistComplete = $this->convertDate($this->getRowValue($row, 'fill_tss_checklist_complete'));
            $reviewByPe = $this->convertDate($this->getRowValue($row, 'review_by_pe'));

            // Menghitung selisih hari
            $agingSurveyToTssSubmit = $this->calculateDaysBetween($scmAssignedToFst, $reviewByScm ?: date('Y-m-d'));
            $totalAgingTss = $this->calculateDaysBetween($scmAssignedToFst, $tssrDone ?: date('Y-m-d'));

            // Tambahkan data ke array rows untuk batch insert
            $this->rows[] = [
                'customer_name' => $this->getRowValue($row, 'customer_name'),
                'project_name' => $this->getRowValue($row, 'project_name'),
                'po_number' => $this->getRowValue($row, 'po_number'),
                'scopes' => $this->getRowValue($row, 'p_scopes_ranmwcmeps'),
                'cluster' => $this->getRowValue($row, 'cluster_province'),
                'region' => $this->getRowValue($row, 'region'),
                'implementation_vendor' => $implementationVendor,
                'site_id' => $this->getRowValue($row, 'site_id'),
                'site_name' => $this->getRowValue($row, 'site_name'),
                'module_id' => $this->getRowValue($row, 'module_id'),
                'module_name' => $this->getRowValue($row, 'module_name'),
                'smp_id' => $this->getRowValue($row, 'smp_id'),
                'smp_name' => $this->getRowValue($row, 'smp_name'),
                'nokia_assign_to_scm' => $nokiaAssignToScm,
                'scm_assign_to_hs_manager' => $scmAssignToHsManager,
                'scm_assigned_to_fst' => $scmAssignedToFst,
                'fill_tss_checklist_1_done' => $fillTssChecklist1Done,
                'fill_tss_checklist_2_done' => $fillTssChecklist2Done,
                'fill_tss_checklist_complete' => $fillTssChecklistComplete,
                'review_by_scm' => $reviewByScm,
                'review_by_pe' => $reviewByPe,
                'tssr_done' => $tssrDone,
                'aging_survey_to_tss_submit' => $agingSurveyToTssSubmit,
                'total_aging_tss' => $totalAgingTss,
            ];

            // Insert ketika batch size tercapai
            if (count($this->rows) >= $this->batchSize) {
                $this->insertBatch();
            }

            return null;

        } catch (\Exception $e) {
            // Catat error di log
            Log::error('Error occurred during import', ['message' => $e->getMessage(), 'row' => $row]);
            
            // Lempar error agar bisa ditangkap di controller
            throw $e;
        }
    }

    // Fungsi untuk batch insert
    private function insertBatch()
    {
        try {
            PbiTss::insert($this->rows); // Batch insert
            Log::info('Batch insert completed for ' . count($this->rows) . ' rows.');
        } catch (\Exception $e) {
            Log::error('Error during batch insert: ' . $e->getMessage());
        }

        // Kosongkan rows setelah batch insert
        $this->rows = [];
    }

    // Fungsi untuk menghitung selisih hari
    private function calculateDaysBetween($startDate, $endDate)
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $interval = $start->diff($end);

        return $interval->days;
    }

    // Chunk size untuk chunk reading
    public function chunkSize(): int
    {
        return 1000;
    }

    // Destructor untuk insert batch terakhir ketika objek dihapus
    public function __destruct()
    {
        if (!empty($this->rows)) {
            $this->insertBatch(); // Insert rows yang tersisa
        }
    }
}
