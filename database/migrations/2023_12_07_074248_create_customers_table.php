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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob')->nullable();
            $table->string('snn')->nullable();
            $table->string('general_info_sex')->nullable();
            $table->string('general_info_race')->nullable();
            $table->string('general_info_ic')->nullable();
            $table->string('general_info_nationality')->nullable();
            $table->string('general_info_passport')->nullable();
            $table->string('general_info_occupation')->nullable();
            $table->string('general_info_website')->nullable();
            $table->string('general_info_marital')->nullable();
            $table->string('general_info_decease_date')->nullable();
            $table->string('general_info_notes')->nullable();
            $table->string('privateinfo_caregiver_responsibilities')->nullable();
            $table->string('privateinfo_caregiver_requirements')->nullable();
            $table->string('privateinfo_caregiver_notes')->nullable();
            $table->string('privateinfo_caregiver_referrel_code')->nullable();
            $table->string('contact_info_address')->nullable();
            $table->string('contact_info_phone')->nullable();
            $table->string('contact_info_city')->nullable();
            $table->string('contact_info_state')->nullable();
            $table->string('contact_info_zip')->nullable();
            $table->string('contact_info_country')->nullable();
            $table->string('contact_info_mobile')->nullable();
            $table->string('contact_info_fax')->nullable();
            $table->string('contact_info_email')->nullable();
            $table->string('contact_info_latitude')->nullable();   
            $table->string('contact_info_longitude')->nullable();
            $table->date('contact_info_dob')->nullable();
            $table->string('emergencyfname')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('emergency_lname')->nullable();
            $table->string('emergency_mobile')->nullable();
            $table->string('emergency_address')->nullable();
            $table->string('emergency_fax')->nullable();
            $table->string('emergency_email')->nullable();
            $table->string('emergency_relation')->nullable();
            $table->string('emergency_city')->nullable();
            $table->string('emergency_state')->nullable();
            $table->string('emergency_zip')->nullable();
            $table->string('emergency_country')->nullable();
            $table->string('emergency_geo_latitude')->nullable();
            $table->string('emergency_longitude')->nullable();
            $table->date('emergency_dob')->nullable();
            $table->string('emergency_cf_fname')->nullable();
            $table->string('emergency_cf_phone')->nullable();
            $table->string('emergency_cf_lname')->nullable();
            $table->string('emergency_cf_mobile')->nullable();
            $table->string('emergency_cf_address')->nullable();
            $table->string('emergency_cf_fax')->nullable();
            $table->string('emergency_cf_email')->nullable();
            $table->string('emergency_cf_relation')->nullable();
            $table->string('emergency_cf_city')->nullable();
            $table->string('emergency_cf_zip')->nullable();
            $table->string('emergency_cf_state')->nullable();
            $table->string('emergency_cf_country')->nullable();
            $table->string('emergency_cf_geo_latitude')->nullable();
            $table->string('emergency_cf_longitude')->nullable();
            $table->date('emergency_cf_dob')->nullable();
            $table->string('care_medical_situation')->nullable();
            $table->string('care_medical_history')->nullable();
            $table->string('care_Surgical_History')->nullable();
            $table->string('care_care_nature')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
