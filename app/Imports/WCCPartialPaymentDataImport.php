<?php

namespace App\Imports;

use App\Models\WCCPartialPaymentData;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class WCCPartialPaymentDataImport implements ToModel, WithHeadingRow
{
    public function __construct()
    {
        // Hapus semua data dari tabel sebelum impor
        WCCPartialPaymentData::truncate();
        Log::info('All previous data deleted from wcc_partial_payment_data table.');
    }

    private function convertDate($excelDate)
    {
        if (is_numeric($excelDate)) {
            $dateTime = Date::excelToDateTimeObject($excelDate);
            return $dateTime->format('Y-m-d');
        }
        return $excelDate; // Return as is if it's not numeric
    }

    public function model(array $row)
    {
        // Debugging line to check the row data
        //dd($row);
        Log::info('Row data:', $row);

        // Exclude specific phase groups and null values
        $excludePhaseGroups = [
            'AOP2022MOCNINT', 'AOP2022MOCNEXP', 'AOP2022TOMAQ1EXP', 'AOP2022MOCNREL',
            'AOP2021BAT2PH2CAP', 'AOP2021BAT2CAP', 'AOP2021BAT6NEW', 'AOP2021BAT2NEW',
            'AOP2021BAT2PH3ACAP', 'AOP2021BAT6CAP', 'AOP2021BAT4NEW', 'AOP2021BAT3PH1B2SNEW',
            'AOP2022TOMAQ1NEW', 'AOP2021BAT3PH1NEW', 'AOP2020Q12021NEW', 'AOP2020SNAPJUN',
            'SNAPMAY19'
        ];

        if (is_null($row['phase_group']) || in_array($row['phase_group'], $excludePhaseGroups)) {
            Log::info('Row excluded due to phase_group:', ['phase_group' => $row['phase_group']]);
            return null; // Skip this row
        }

        // Remove '=' character from wcc_approval_categorize
        $wccApprovalCategorize = isset($row['wcc_approval_categorize']) ? str_replace('=', '', $row['wcc_approval_categorize']) : null;

        // Map Excel columns to SQL columns
        $data = new WCCPartialPaymentData([
            'project' => $row['project'] ?? null,
            'phase_group' => $row['phase_group'] ?? null,
            'project_phase' => $row['project_phase'] ?? null,
            'system_key' => $row['system_key'] ?? null,
            'site_id' => $row['site_id'] ?? null,
            'site_name' => $row['site_name'] ?? null,
            'region' => $row['region'] ?? null,
            'smp_id' => $row['smp_id'] ?? null,
            'smp_name' => $row['smp_name'] ?? null,
            'module_id' => $row['module_id'] ?? null,
            'module_name' => $row['module_name'] ?? null,
            'module_vendor_name' => $row['module_vendor_name'] ?? null,
            'module_percentage' => $row['percentage'] ?? null,
            'ewcc_module_id' => $row['ewcc_module_id'] ?? null,
            'ewcc_module_name' => $row['ewcc_module_name'] ?? null,
            'ewcc_module_vendor_name' => $row['ewcc_module_vendor_name'] ?? null,
            'ewcc_module_percentage' => $row['ewcc_module_percentage'] ?? null,
            'service_task' => $row['service_task'] ?? null,
            'spo_number' => $row['spo_number'] ?? null,
            'spo_date' => isset($row['spo_date']) ? $this->convertDate($row['spo_date']) : null,
            'services_commencement_date' => isset($row['services_commencement_date']) ? $this->convertDate($row['services_commencement_date']) : null,
            'target_time_of_completion' => isset($row['target_time_of_completion']) ? $this->convertDate($row['target_time_of_completion']) : null,
            'actual_time_of_completion' => isset($row['actual_time_of_completion']) ? $this->convertDate($row['actual_time_of_completion']) : null,
            'delay_justification' => $row['delay_justification'] ?? null,
            'spo_vendor_name' => $row['spo_vendor_name'] ?? null,
            'wcc_certificate_number' => $row['wcc_cert_number'] ?? null,
            'wcc_assign_by_nokia' => isset($row['wcc_assign_by_nokia']) ? $this->convertDate($row['wcc_assign_by_nokia']) : null,
            'wcc_reason_reject' => $row['wcc_reason_reject'] ?? null,
            'wcc_reject_date' => isset($row['wcc_reject_date']) ? $this->convertDate($row['wcc_reject_date']) : null,
            'task_owner_name' => $row['task_owner_name'] ?? null,
            'aging_submition' => $row['aging_submition'] ?? null,
            'aging_approval' => $row['aging_approval'] ?? null,
            'milestone_id' => $row['milestone_id'] ?? null,
            'milestone_name' => $row['milestone_name'] ?? null,
            'gr_status' => $row['gr_status'] ?? null,
            'task_hyperlink' => $row['task_hyperlink'] ?? null,
            'wcc_submit_date' => isset($row['wcc_submit_date']) ? $this->convertDate($row['wcc_submit_date']) : null,
            'wcc_verification_date' => isset($row['wcc_verification_date']) ? $this->convertDate($row['wcc_verification_date']) : null,
            'wcc_approve_date' => isset($row['wcc_approve_date']) ? $this->convertDate($row['wcc_approve_date']) : null,
            'ld_status' => $row['ld_status'] ?? null,
            'ld_percentage' => $row['ld'] ?? null,
            'ld_days' => $row['ld_days'] ?? null,
            'remark' => $row['remark'] ?? null,
            'matching_status' => $row['matching_status'] ?? null,
            'aging_wcc_assign_by_nokia' => $row['aging_wcc_assign_by_nokia'] ?? null,
            'assign_by_nokia_categorize' => $row['assign_by_nokia_categorize'] ?? null,
            'aging_for_wcc_submission_date' => $row['aging_for_wcc_submission_date'] ?? null,
            'wcc_submission_date_categorize' => $row['wcc_sumission_date_categorize'] ?? null,
            'aging_wcc_approval' => $row['aging_for_wcc_approval'] ?? null, // Pastikan nama header sesuai
            'wcc_approval_categorize' => $wccApprovalCategorize,
            'loi_date' => isset($row['loi_date']) ? $this->convertDate($row['loi_date']) : null,
            'loi_number' => $row['loi_number'] ?? null,
        ]);

        // Debug log before saving
        Log::info('Model Attributes before save:', $data->toArray());

        if ($data->save()) {
            Log::info('Data saved successfully:', $data->toArray());
        } else {
            Log::error('Failed to save data:', $data->toArray());
        }

        return $data;
    }
}