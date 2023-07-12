<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_field_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_field_id')->constrained('product_fields')->onDelete('cascade')->onUpdate('cascade')->references('id')->on('product_fields');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->onUpdate('cascade')->references('id')->on('products');
            $table->integer('value')->unsigned();
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_field_values');
    }
};
