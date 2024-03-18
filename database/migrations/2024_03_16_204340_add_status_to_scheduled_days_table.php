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
        Schema::table('scheduled_days', function (Blueprint $table) {
            //
            $table->string('status')->default('assign')->comment('Status of the scheduled day: assign, failed, approve');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scheduled_days', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });
    }
};
