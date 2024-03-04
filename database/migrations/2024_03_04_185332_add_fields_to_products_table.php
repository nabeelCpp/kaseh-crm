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
        Schema::table('products', function (Blueprint $table) {
            $table->string('treatment_type');
            $table->unsignedInteger('no_of_hrs_per_day')->nullable();
            $table->unsignedInteger('no_of_days_per_week')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['treatment_type', 'no_of_hrs_per_day', 'no_of_days_per_week']);
        });
    }
};
