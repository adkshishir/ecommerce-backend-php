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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('slug')->unique();
            $table->string('status')->default('active');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->float('marked_price');
            $table->float('discount');
            $table->integer('total_stocks');
            $table->longText('details')->nullable();
            $table->string('aditional_information')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
