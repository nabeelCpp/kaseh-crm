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
        Schema::create('sub_quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_id');
            $table->string('product_id');
            $table->string('description');
            $table->string('service_from')->nullable();
            $table->string('service_to')->nullable();
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_quotation');
    }
};
