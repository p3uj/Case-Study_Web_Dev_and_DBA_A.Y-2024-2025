<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- GET ALL PROPERTIES
        DB::statement("
            CREATE PROC RE_SP_GET_ALL_PROPERTY_POST_INFO_RATING
            AS
            SELECT TOP 4
                PPost.id AS Post
                ,PInfo.id AS Info
                ,(
                    SELECT TOP 1 photo_path
                    FROM unit_photos
                    WHERE property_info_id = PInfo.id
                ) AS FirstPhoto
                ,PInfo.unit_category
                ,PInfo.city + ', ' + PInfo.barangay AS location
                ,PInfo.rental_price
                ,COALESCE(ROUND(CAST(AVG(CAST(R.rating AS DECIMAL(10, 2))) AS DECIMAL(10, 2)), 2), 0) AS Rating
            FROM property_infos AS PInfo
            INNER JOIN property_posts AS PPost
                ON PInfo.id = PPost.property_info_id
            LEFT JOIN reviews AS R
                ON PPost.id = R.property_post_id
            GROUP BY PPost.id, PInfo.id, PInfo.unit_category, PInfo.city, PInfo.barangay, PInfo.rental_price
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_ALL_PROPERTY_POST_INFO_RATING");
    }
};
