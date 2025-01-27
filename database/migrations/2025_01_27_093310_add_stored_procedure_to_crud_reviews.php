<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE PROCEDURE RE_SP_GET_PROPERTIES_TO_BE_REVIEWED
                @p_UserId BIGINT
            AS
            SELECT
                ,R.id
                ,(
                    SELECT TOP 1 photo_path
                    FROM unit_photos
                    WHERE property_info_id = PInfo.id
                ) AS FirstPhoto
                ,R.created_at
                ,R.lease_end
                ,PInfo.city
                ,PInfo.barangay
                ,PInfo.unit_category
                ,PInfo.rental_price
                ,PInfo.description
            FROM reviews AS R
            LEFT JOIN property_posts AS PPost
                ON PPost.id = R.property_post_id
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            WHERE 
                R.review_by_user_id = @p_UserId
                AND R.lease_end IS NOT NULL
            ORDER BY R.updated_at DESC
        ");

        DB::statement("
            CREATE PROCEDURE RE_SP_GET_TENANTS_TO_BE_REVIEWED
                @p_UserId BIGINT
            AS
            SELECT
                R.id
                ,R.created_at
                ,R.lease_end
                ,U.firstname
                ,U.lastname
                ,PInfo.City
                ,PInfo.barangay
            FROM reviews AS R
            LEFT JOIN property_posts AS PPost
                ON PPost.id = R.property_post_id
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            INNER JOIN users AS U
                ON U.id = R.review_to_user_id
            WHERE 
                R.review_by_user_id = 1
                AND R.lease_end IS NOT NULL
            ORDER BY R.updated_at DESC
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_PROPERTIES_TO_BE_REVIEWED");
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_TENANTS_TO_BE_REVIEWED");
    }
};