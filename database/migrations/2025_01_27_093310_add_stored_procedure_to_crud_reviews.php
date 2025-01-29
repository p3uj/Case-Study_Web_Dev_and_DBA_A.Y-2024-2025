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
                R.id
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
            FROM property_posts AS PPost
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            RIGHT JOIN reviews AS R
                ON R.property_post_id = PPost.id
            WHERE 
                R.review_by_user_id = @p_UserId
                AND R.lease_end IS NOT NULL
        ");

        DB::statement("
            CREATE PROCEDURE RE_SP_GET_TENANTS_TO_BE_REVIEWED
                @p_UserId BIGINT
            AS
            SELECT
                R.id
                ,R.created_at
                ,R.lease_end
                ,(
                    SELECT profile_photo_path
                    FROM users AS U
                    WHERE U.id = R.review_to_user_id
                ) AS pfp
                ,(
                    SELECT firstname
                    FROM users AS U
                    WHERE U.id = R.review_to_user_id
                ) AS firstname
                ,(
                    SELECT lastname
                    FROM users AS U
                    WHERE U.id = R.review_to_user_id
                ) AS lastname
                ,PInfo.city
                ,PInfo.barangay
            FROM property_posts AS PPost
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            RIGHT JOIN reviews AS R
                ON R.property_post_id = PPost.id
            WHERE
                review_by_user_id = @p_UserId
                AND lease_end IS NOT NULL
        ");

        DB::statement("
            CREATE PROCEDURE RE_SP_INSERT_REVIEW
                @p_PPostId INT,
                @p_ReviewBy INT,
                @p_ReviewTo INT
            AS
            BEGIN
                INSERT INTO reviews (
                    property_post_id
                    ,review_by_user_id
                    ,review_to_user_id)
                VALUES (
                    @p_PPostId
                    ,@p_ReviewBy
                    ,@p_ReviewTo);
            END
        ");

        DB::statement("
            CREATE PROCEDURE RE_SP_GET_LANDLORD_REVIEW_BY_ID
                @p_ReviewId INT
            AS
            SELECT
                R.id
                ,R.created_at
                ,R.lease_end
                ,(
                    SELECT profile_photo_path
                    FROM users AS U
                    WHERE U.id = R.review_to_user_id
                ) AS pfp
                ,(
                    SELECT firstname
                    FROM users AS U
                    WHERE U.id = R.review_to_user_id
                ) AS firstname
                ,(
                    SELECT lastname
                    FROM users AS U
                    WHERE U.id = R.review_to_user_id
                ) AS lastname
                ,PInfo.city
                ,PInfo.barangay
            FROM property_posts AS PPost
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            RIGHT JOIN reviews AS R
                ON R.property_post_id = PPost.id
            WHERE
                R.id = @p_ReviewId
        ");

        DB::statement("
            CREATE PROCEDURE RE_SP_RE_SP_GET_TENANT_REVIEW_BY_ID
                @p_ReviewId INT
            AS
            SELECT
                R.id
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
            FROM property_posts AS PPost
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            RIGHT JOIN reviews AS R
                ON R.property_post_id = PPost.id
            WHERE 
                R.id = @p_ReviewId
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_PROPERTIES_TO_BE_REVIEWED");
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_TENANTS_TO_BE_REVIEWED");
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_INSERT_REVIEW");
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_REVIEW_BY_ID");
    }
};