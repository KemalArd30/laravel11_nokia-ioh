<?php

namespace App\Imports;

use App\Models\PbiProject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PbiProjectImport implements ToModel, WithHeadingRow, WithChunkReading
{
    protected $rows = []; // Menampung data untuk batch insert
    protected $batchSize = 500; // Ukuran batch untuk batch insert
    private $expectedColumns = [ // Daftar kolom yang diharapkan
        'region',
        'country_name',
        'project_name',
        'project_phase',
        'phase_group',
        'project_year',
        'system_key',
        'boq_no',
        'site_id',
        'site_name',
        'site_category',
        'smp_id',
        'smp_name',
        'smp_status',
        'wbs_code',
        'smp_site_type',
        'scope',
        'technology',
        'product_configuration',
        'module_id',
        'module_name',
        'module_status',
        'implementation_vendor_name',
        'milestone_inchstone',
        'task_id',
        'task_name',
        'task_status',
        'baseline_end_date',
        'forecast_end_date',
        'actual_end_date',
        'market_unit',
        'cpo_number',
        'ne_type'
    ];

    public function __construct()
    {
        // Hapus semua data dari tabel sebelum impor, menggunakan TRUNCATE untuk efisiensi
        DB::statement('TRUNCATE TABLE pbi_project');
        Log::info('All previous data deleted from pbi_project table.');
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

            $implementationVendorName = $this->getRowValue($row, 'implementation_vendor_name');

            // Hanya memproses baris yang memiliki implementation_vendor "PT INTISEL PRODAKTIFAKOM"
            if ($implementationVendorName !== 'PT INTISEL PRODAKTIFAKOM') {
                Log::info('Skipping row with implementation_vendor_name: ' . $implementationVendorName);
                return null;
            }

            // Konversi tanggal
            $baselineEndDate = $this->convertDate($this->getRowValue($row, 'baseline_end_date'));
            $forecastEndDate = $this->convertDate($this->getRowValue($row, 'forecast_end_date'));
            $actualEndDate = $this->convertDate($this->getRowValue($row, 'actual_end_date'));

            // Tambahkan data ke array rows untuk batch insert
            $this->rows[] = [
                'region' => $this->getRowValue($row, 'region'),
                'country' => $this->getRowValue($row, 'country_name'),
                'project_name' => $this->getRowValue($row, 'project_name'),
                'project_phase' => $this->getRowValue($row, 'project_phase'),
                'phase_group' => $this->getRowValue($row, 'phase_group'),
                'project_year' => $this->getRowValue($row, 'project_year'),
                'system_key' => $this->getRowValue($row, 'system_key'),
                'boq_no' => $this->getRowValue($row, 'boq_no'),
                'site_id' => $this->getRowValue($row, 'site_id'),
                'site_name' => $this->getRowValue($row, 'site_name'),
                'site_category' => $this->getRowValue($row, 'site_category'),
                'smp_id' => $this->getRowValue($row, 'smp_id'),
                'smp_name' => $this->getRowValue($row, 'smp_name'),
                'smp_status' => $this->getRowValue($row, 'smp_status'),
                'wbs_code' => $this->getRowValue($row, 'wbs_code'),
                'smp_site_type' => $this->getRowValue($row, 'smp_site_type'),
                'scope' => $this->getRowValue($row, 'scope'),
                'technology' => $this->getRowValue($row, 'technology'),
                'product_configuration' => $this->getRowValue($row, 'product_configuration'),
                'module_id' => $this->getRowValue($row, 'module_id'),
                'module_name' => $this->getRowValue($row, 'module_name'),
                'module_status' => $this->getRowValue($row, 'module_status'),
                'implementation_vendor_name' => $implementationVendorName,
                'milestone_and_inchstone' => $this->getRowValue($row, 'milestone_inchstone'),
                'task_id' => $this->getRowValue($row, 'task_id'),
                'task_name' => $this->getRowValue($row, 'task_name'),
                'task_status' => $this->getRowValue($row, 'task_status'),
                'baseline_end_date' => $baselineEndDate,
                'forecast_end_date' => $forecastEndDate,
                'actual_end_date' => $actualEndDate,
                'market_unit' => $this->getRowValue($row, 'market_unit'),
                'cpo_number' => $this->getRowValue($row, 'cpo_number'),
                'ne_type' => $this->getRowValue($row, 'ne_type'),
            ];

            /// Insert ketika batch size tercapai
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
            PbiProject::insert($this->rows); // Batch insert
            Log::info('Batch insert completed for ' . count($this->rows) . ' rows.');
        } catch (\Exception $e) {
            Log::error('Error during batch insert: ' . $e->getMessage());
        }

        // Kosongkan rows setelah batch insert
        $this->rows = [];
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
