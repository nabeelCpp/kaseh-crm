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
        Schema::create('caregivers', function (Blueprint $table) {
            Schema::create('caregivers', function (Blueprint $table) {
                $table->id();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('nick_name')->nullable();
                $table->string('nationality')->nullable();
                $table->string('ic_number')->nullable();
                $table->string('mobile')->nullable();
                $table->string('profile')->nullable();
                $table->string('passport')->nullable();
                $table->date('passport_expiry_date')->nullable();
                $table->string('visa')->nullable();
                $table->date('visa_expiry_date')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('age')->nullable();
                $table->string('gender')->nullable();
                $table->string('marital_status')->nullable();
                $table->string('email')->nullable();
                $table->string('profession')->nullable();
                $table->string('trasportation')->nullable();
                $table->string('status')->nullable();
                $table->string('how_find_caregiver')->nullable();
                $table->string('availability')->nullable();
                $table->date('date_of_availability')->nullable();
                $table->string('hashtag')->nullable();
                $table->string('address_one')->nullable();
                $table->string('address_two')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->string('state')->nullable();
                $table->string('postcode')->nullable();
                $table->string('bank_name')->nullable();
                $table->string('bank_account')->nullable();
                $table->string('bank_cardholder')->nullable();
                $table->string('xero_id')->nullable();
                $table->string('internal_remarks')->nullable();
                $table->string('skills')->nullable();
                $table->string('height')->nullable()->after('skills');
                $table->string('weight')->nullable()->after('height');
                $table->string('trainer')->nullable()->after('weight');
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caregivers');
    }
};
