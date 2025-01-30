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
            CREATE PROC RE_SP_GET_USER_PENDING_RENTALS
                @p_UserId INT
            AS
            SELECT
                R.id
                ,PPost.id AS Post
                ,(
                    SELECT TOP 1 photo_path
                    FROM unit_photos
                    WHERE property_info_id = PInfo.id
                ) AS FirstPhoto
                ,PInfo.unit_category
                ,PInfo.city
                ,PInfo.barangay
                ,PInfo.rental_price
                ,PInfo.max_occupancy
            FROM property_posts AS PPost
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            RIGHT JOIN reviews AS R
                ON R.property_post_id = PPost.id
            WHERE
                R.review_by_user_id = @p_UserId
                AND R.lease_end IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_USER_PENDING_RENTALS");
    }
};
