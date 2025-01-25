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
        //-- Define stored procedure to get all property posts with ratings based on the user id
        DB::statement("
            CREATE PROC RE_SP_GET_PROPERTY_POSTS_WITH_RATINGS_BY_USER_ID
                @p_UserId BIGINT
            AS
            SELECT
                PPost.*
                ,PInfo.*
                ,COALESCE(ReviewRating.Rating, 0) AS Rating
                ,(
                    SELECT TOP 1 photo_path
                    FROM unit_photos
                    WHERE property_info_id = PInfo.id
                ) AS FirstPhoto
            FROM RE_V_GET_ALL_ACTIVE_PROPERTY_POST_WITH_USERNAME AS PPost
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            LEFT JOIN (
                SELECT
                    property_post_id
                    ,AVG(rating) AS Rating
                FROM reviews
                GROUP BY property_post_id
            ) AS ReviewRating ON ReviewRating.property_post_id = PPost.id
            WHERE PPost.user_id = @p_UserId
            ORDER BY PPost.updated_at DESC
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view
        DB::statement("DROP VIEW IF EXISTS RE_SP_GET_PROPERTY_POSTS_WITH_RATINGS_BY_USER_ID");
    }
};
