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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('phone_number')->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('total_price')->nullable();
            $table->integer('profit')->nullable();
            $table->timestamps();

            // Corrected foreign key reference to 'products'
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
