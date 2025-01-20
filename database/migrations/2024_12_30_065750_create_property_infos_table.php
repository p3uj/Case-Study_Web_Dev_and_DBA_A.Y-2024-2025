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
        Schema::create('property_infos', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('barangay');
            $table->string('unit_category');
            $table->decimal('rental_price', 10, 2);
            $table->integer('max_occupancy');
            $table->text('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_infos');
    }
};
