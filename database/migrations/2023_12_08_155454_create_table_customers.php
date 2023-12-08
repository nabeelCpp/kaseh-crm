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
            $table->integer('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age')->nullable();
            $table->string('snn')->nullable();
            $table->string('general_info_sex')->nullable();
            $table->string('general_info_race')->nullable();
            $table->string('general_info_nationality')->nullable();
            $table->string('general_info_occupation')->nullable();
            $table->string('general_info_marital')->nullable();
            $table->string('general_info_notes')->nullable();
            $table->string('contact_info_address')->nullable();
            $table->string('contact_info_phone')->nullable();
            $table->string('contact_info_city')->nullable();
            $table->string('contact_info_state')->nullable();
            $table->string('contact_info_zip')->nullable();
            $table->string('contact_info_country')->nullable();
            $table->string('contact_info_mobile')->nullable();
            $table->string('contact_info_email')->nullable();
            $table->string('emergencyfname')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('emergency_lname')->nullable();
            $table->string('emergency_mobile')->nullable();
            $table->string('emergency_address')->nullable();
            $table->string('emergency_email')->nullable();
            $table->string('emergency_relation')->nullable();
            $table->string('emergency_city')->nullable();
            $table->string('emergency_state')->nullable();
            $table->string('emergency_zip')->nullable();
            $table->string('emergency_country')->nullable();
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
        Schema::dropIfExists('table_customers');
    }
};
