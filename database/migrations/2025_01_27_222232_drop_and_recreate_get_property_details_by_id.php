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
        //
        // Drop the old stored procedure if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_PROPERTY_POSTS_WITH_RATINGS_BY_USER_ID");
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_PROPERTY_DETAILS_BY_ID");

        //-- Define stored procedure to get all the property posts with ratings and 1 unit photo based on the user id
        // -- Get all property post details including ratings, user name and its profile photo
        DB::statement("
            CREATE PROC RE_SP_GET_PROPERTY_DETAILS_BY_ID
                @p_UserId BIGINT = NULL
                ,@p_PropertyPostId BIGINT = NULL
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
                                ,AVG(rating) AS Rating
                                FROM reviews
                                GROUP BY property_post_id
                            ) AS ReviewRating ON ReviewRating.property_post_id = PPost.id
                    INNER JOIN users
                        ON users.id = PPost.user_id
                    WHERE PPost.id = @p_PropertyPostId
                END
            ELSE
                --Get all property posts with ratings and 1 unit photo based on the user id
                BEGIN
                    SELECT
                        PPost.*
                        ,PInfo.barangay + ', ' + PInfo.city AS Location
                        ,PInfo.unit_category
                        ,PInfo.rental_price
                        ,PInfo.max_occupancy
                        ,PInfo.description
                        ,PInfo.updated_at
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
                END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the stored procedure if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_PROPERTY_POSTS_WITH_RATINGS_BY_USER_ID");
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_PROPERTY_DETAILS_BY_ID");
    }
};
