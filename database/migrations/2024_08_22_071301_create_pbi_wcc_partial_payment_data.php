<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pbi_wcc_partial_payment_data', function (Blueprint $table) {
            $table->string('project')->nullable();
            $table->string('phase_group')->nullable();
            $table->string('project_phase')->nullable();
            $table->string('system_key')->nullable();
            $table->string('site_id')->nullable();
            $table->string('site_name')->nullable();
            $table->string('region')->nullable();
            $table->string('smp_id')->nullable();
            $table->string('smp_name')->nullable();
            $table->string('module_id')->nullable();
            $table->string('module_name')->nullable();
            $table->string('module_vendor_name')->nullable();
            $table->integer('module_percentage')->nullable();
            $table->string('ewcc_module_id')->nullable();
            $table->string('ewcc_module_name')->nullable();
            $table->string('ewcc_module_vendor_name')->nullable();
            $table->integer('ewcc_module_percentage')->nullable();
            $table->string('service_task')->nullable();
            $table->string('spo_number')->nullable();
            $table->date('spo_date')->nullable();
            $table->date('services_commencement_date')->nullable();
            $table->date('target_time_of_completion')->nullable();
            $table->date('actual_time_of_completion')->nullable();
            $table->string('delay_justification')->nullable();
            $table->string('spo_vendor_name')->nullable();
            $table->string('wcc_certificate_number')->nullable();
            $table->date('wcc_assign_by_nokia')->nullable();
            $table->string('wcc_reason_reject')->nullable();
            $table->date('wcc_reject_date')->nullable();
            $table->string('task_owner_name')->nullable();
            $table->integer('aging_submition')->nullable();
            $table->integer('aging_approval')->nullable();
            $table->string('milestone_id')->nullable();
            $table->string('milestone_name')->nullable();
            $table->string('gr_status')->nullable();
            $table->string('task_hyperlink')->nullable();
            $table->date('wcc_submit_date')->nullable();
            $table->date('wcc_verification_date')->nullable();
            $table->date('wcc_approve_date')->nullable();
            $table->string('ld_status')->nullable();
            $table->string('ld_percentage')->nullable();
            $table->integer('ld_days')->nullable();
            $table->string('remark')->nullable();
            $table->string('matching_status')->nullable();
            $table->integer('aging_wcc_assign_by_nokia')->nullable();
            $table->string('assign_by_nokia_categorize')->nullable();
            $table->integer('aging_for_wcc_submission_date')->nullable();
            $table->string('wcc_submission_date_categorize')->nullable();
            $table->integer('aging_wcc_approval')->nullable();
            $table->string('wcc_approval_categorize')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pbi_wcc_partial_payment_data');
    }
};
