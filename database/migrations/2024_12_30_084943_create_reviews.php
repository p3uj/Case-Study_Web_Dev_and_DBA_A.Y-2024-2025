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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_post_id')->nullable()->constrained('property_posts');
            $table->foreignId('review_by_user_id')->constrained('users');
            $table->foreignId('review_to_user_id')->constrained('users');
            $table->integer('rating')->nullable();
            $table->text('review_text')->nullable();
            $table->boolean('is_reviewed')->default(false);
            $table->boolean('is_edited')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('lease_end')->nullable();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
