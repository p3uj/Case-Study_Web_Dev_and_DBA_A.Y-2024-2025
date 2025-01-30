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
            CREATE PROC RE_SP_GET_TOP_RATED_PROPERTIES
            AS
            SELECT TOP 6 
                (
                    SELECT TOP 1 photo_path 
                    FROM unit_photos 
                    WHERE property_info_id = PInfo.id 
                    ORDER BY id
                ) AS FirstPhoto
                ,PInfo.unit_category
                ,PInfo.city + ', ' + PInfo.barangay AS location
            FROM property_infos AS PInfo
            INNER JOIN property_posts AS PPost
                ON PInfo.id = PPost.property_info_id
            LEFT JOIN reviews AS R
                ON PPost.id = R.property_post_id
            GROUP BY PPost.id, PInfo.id, PInfo.unit_category, PInfo.city, PInfo.barangay
            ORDER BY COALESCE(AVG(CAST(R.rating AS DECIMAL(10, 2))), 0) DESC
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS  RE_SP_GET_TOP_RATED_PROPERTIES");
    }
};
