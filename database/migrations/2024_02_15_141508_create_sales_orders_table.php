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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->nullable();
            $table->integer('user_id');
            $table->integer('customer_id');
            $table->integer('caregiver_id');
            $table->float('total_invoiced');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('remarks')->nullable();
            $table->enum('stage', ['finance to invoice', 'ongoing', 'completed'])->default('ongoing');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
