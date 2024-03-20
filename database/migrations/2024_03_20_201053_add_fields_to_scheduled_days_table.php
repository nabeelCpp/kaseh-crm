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
            $table->text('remarks')->nullable();
            $table->integer('reviewed_by')->nullable();
            $table->text('reason_for_refuse')->nullable();
            $table->boolean('invoiced')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scheduled_days', function (Blueprint $table) {
            $table->dropColumn('remarks');
            $table->dropColumn('reviewed_by');
            $table->dropColumn('reason_for_refuse');
            $table->dropColumn('invoiced');
        });
    }
};
