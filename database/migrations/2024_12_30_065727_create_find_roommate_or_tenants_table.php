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
        Schema::create('find_roommate_or_tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key referencing users(id)
            $table->dateTime('date_posted');
            $table->string('city');
            $table->string('barangay');
            $table->text('description');
            $table->boolean('is_already_found')->default(false);
            $table->string('category_finding');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('find_roommate_or_tenants');
    }
};
