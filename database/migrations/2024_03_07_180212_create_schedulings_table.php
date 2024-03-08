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
        Schema::create('schedulings', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_order_id');
            $table->unsignedBigInteger('caregiver_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('scheduled_by');
            $table->timestamps();

            $table->foreign('caregiver_id')->references('id')->on('caregivers')->onDelete('cascade');
            $table->foreign('scheduled_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedulings');
    }
};
