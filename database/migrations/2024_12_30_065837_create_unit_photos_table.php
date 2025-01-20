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
        Schema::create('unit_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_info_id')->constrained('property_infos');
            $table->string('photo_path');
            $table->timestamp('created_at')->useCurrent();
            $table->boolean('is_deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_photos');
    }
};
