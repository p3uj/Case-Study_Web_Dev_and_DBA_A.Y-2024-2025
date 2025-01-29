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
        // Drop old view
        DB::statement('DROP PROCEDURE IF EXISTS RE_SP_GET_PROPERTY_DETAILS_BY_ID');

        // -- DEFINE STORED PROCEDURE TO GET PROPERTY DETAILS BASED ON THE ID
        DB::statement("
            CREATE PROC RE_SP_GET_PROPERTY_DETAILS_BY_ID
                @p_UserId BIGINT = NULL
                ,@p_PropertyPostId BIGINT = NULL
                ,@p_PropertyInfoId BIGINT = NULL
            AS
            IF @p_PropertyPostId IS NOT NULL
                -- GET PROPERTY POST ID, UPDATED AT AND PROPERTY INFO BASED ON THE PROPERTY ID WITH USERNAME AND PROFILE PHOTO
                BEGIN
                    SELECT
                        PPost.id
                        ,PPost.updated_at
                        ,PInfo.barangay + ', ' + PInfo.city AS Location
                        ,PInfo.unit_category
                        ,PInfo.rental_price
                        ,PInfo.max_occupancy
                        ,PInfo.description
                        ,COALESCE(ReviewRating.Rating, 0) AS Rating
                        ,users.firstname + ' ' + users.lastname AS Username
                        ,users.profile_photo_path AS ProfilePhoto
                    FROM property_posts AS PPost
                    INNER JOIN property_infos AS PInfo
                        ON PInfo.id = PPost.property_info_id
                    LEFT JOIN (
                                SELECT
                                property_post_id
                                ,ROUND(CAST(AVG(CAST(rating AS DECIMAL(10, 2))) AS DECIMAL(10, 2)), 2) AS Rating
                                FROM reviews
                                GROUP BY property_post_id
                            ) AS ReviewRating ON ReviewRating.property_post_id = PPost.id
                    INNER JOIN users
                        ON users.id = PPost.user_id
                    WHERE PPost.id = @p_PropertyPostId
                END
            ELSE IF @p_UserId IS NOT NULL
                -- Get all property posts with ratings and 1 unit photo based on the user id
                BEGIN
                    SELECT
                        PPost.*
                        ,PPost.property_post_updated_at AS updated_at
                        ,PInfo.barangay + ', ' + PInfo.city AS Location
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
                            ,ROUND(CAST(AVG(CAST(rating AS DECIMAL(10, 2))) AS DECIMAL(10, 2)), 2) AS Rating
                        FROM reviews
                        GROUP BY property_post_id
                    ) AS ReviewRating ON ReviewRating.property_post_id = PPost.id
                    WHERE PPost.user_id = @p_UserId
                    ORDER BY PPost.property_post_updated_at DESC
                END
            ELSE IF @p_PropertyInfoId IS NOT NULL
                -- GET PROPERTY POSTS WITH ITS INFO BASED ON THE PROPERTY INFO ID
                BEGIN
                    SELECT
                        *
                    FROM RE_V_GET_ALL_ACTIVE_PROPERTY_POST_WITH_USERNAME AS PPost
                    WHERE PPost.property_info_id = @p_PropertyInfoId
                END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_PROPERTY_DETAILS_BY_ID");
    }
};
