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
        // Create stored procedure
        // Define stored procedure to get all the reviews based on the user id
        DB::statement("
            CREATE PROCEDURE GetAllReviewsByUserId
                @userId BIGINT
            AS
            BEGIN
                SELECT reviews.*, ReviewBy.firstname, ReviewBy.lastname
                FROM reviews
                INNER JOIN users AS ReviewBy
                    ON ReviewBy.id = reviews.review_by_user_id
                WHERE review_to_user_id = @userId
                ORDER BY updated_at DESC
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
    }
};
