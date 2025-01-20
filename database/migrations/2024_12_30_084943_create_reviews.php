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
            $table->foreignId('property_post_id')->constrained('property_posts');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('rating')->nullable();
            $table->text('review_text')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // Create stored procedure
        // Define stored procedure to get all reviews based on the user id
        DB::statement("
            CREATE PROCEDURE GetAllReviewsByUserId
                @userId BIGINT
            AS
            BEGIN
                SELECT reviews.*, ReviewByUser.firstname, ReviewByUser.lastname
                FROM reviews
                INNER JOIN property_posts AS PPost
                    ON PPost.id = reviews.property_post_id
                INNER JOIN users AS PPostOwner
                    ON PPostOwner.id = PPost.user_id
                INNER JOIN users AS ReviewByUser
                    ON ReviewByUser.id = reviews.user_id
                WHERE PPostOwner.id = @userId
                ORDER BY created_at DESC
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the stored procedure
        DB::statement("DROP PROCEDURE IF EXISTS GetAllReviewsByUserId");

        Schema::dropIfExists('reviews');
    }
};
