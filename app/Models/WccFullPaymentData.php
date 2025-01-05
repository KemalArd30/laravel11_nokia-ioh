<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WccFullPaymentData extends Model
{
    protected $table = 'pbi_wcc_full_payment_data';

    // Nonaktifkan fitur timestamps
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'project', 'phase_group', 'project_phase', 'system_key', 'site_id',
        'site_name', 'region', 'smp_id', 'smp_name', 'module_id', 'module_name',
        'module_vendor_name', 'module_percentage', 'ewcc_module_id', 'ewcc_module_name',
        'ewcc_module_vendor_name', 'ewcc_module_percentage', 'service_task', 'spo_number', 'spo_date', 'services_commencement_date',
        'target_time_of_completion', 'actual_time_of_completion', 'delay_justification',
        'spo_vendor_name', 'wcc_certificate_number', 'wcc_assign_by_nokia', 'wcc_reason_reject',
        'wcc_reject_date', 'task_owner_name', 'aging_submition', 'aging_approval', 'milestone_id',
        'milestone_name', 'gr_status', 'task_hyperlink', 'wcc_submit_date', 'wcc_verification_date',
        'wcc_approve_date', 'ld_status', 'ld_percentage', 'ld_days', 'remark', 'matching_status',
        'aging_wcc_assign_by_nokia', 'assign_by_nokia_categorize', 'aging_for_wcc_submission_date',
        'wcc_submission_date_categorize', 'aging_wcc_approval', 'wcc_approval_categorize', 'ms_start_date', 'loi_date', 'loi_number'
    ];

        public function save(array $options = [])
    {
            // Debugging: Lihat data sebelum disimpan
            // Log::info('Model Attributes before save:', $this->attributes);

            return parent::save($options);
    }
}
