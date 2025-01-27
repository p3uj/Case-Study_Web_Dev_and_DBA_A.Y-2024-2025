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
        // Drop the old stored procedure if it exists
        DB::statement("DROP PROCEDURE IF EXISTS GetAllReviewsByUserId");
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_ALL_REVIEWS_BY_USER_ID");

        // Create stored procedure
        // -- Define a stored procedure to get all the reviews received by a user
        DB::statement("
            CREATE PROC RE_SP_GET_ALL_REVIEWS_BY_USER_ID
                @p_UserId BIGINT
            AS
            SELECT
                reviews.*
                ,ReviewBy.firstname + ' ' + ReviewBy.lastname AS UserName
                ,ReviewBy.profile_photo_path
            FROM reviews
            INNER JOIN users AS ReviewBy
                ON ReviewBy.id = reviews.review_by_user_id
            WHERE review_to_user_id = @p_UserId
            ORDER BY updated_at DESC
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the stored procedure
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_ALL_REVIEWS_BY_USER_ID");
    }
};
