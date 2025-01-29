<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('property_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_info_id')->constrained('property_infos');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_available')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->boolean('is_deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop
        Schema::dropIfExists('property_posts');
    }
};
