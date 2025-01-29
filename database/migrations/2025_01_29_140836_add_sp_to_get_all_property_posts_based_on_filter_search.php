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
        // -- DEFINE STORED PROCEDURE TO GET ALL THE PROPERTY POSTS BASED ON THE FILTER SEARCH
        DB::statement("
            CREATE PROC RE_SP_GET_ALL_PROPERTY_POST_BASED_ON_FILTER_SEARCH
                @p_UnitCategory NVARCHAR(255)
                ,@p_City NVARCHAR(255) = NULL
                ,@p_RentalPrice DECIMAL(10, 2) = NULL
            AS
            SELECT
                PPost.id
                ,PPost.property_info_id
                ,PPost.UserName
                ,PInfo.barangay + ', ' + PInfo.city AS Location
                ,PInfo.unit_category
                ,PInfo.description
                ,PInfo.rental_price
                ,(
                    SELECT TOP 1 photo_path
                    FROM unit_photos
                    WHERE property_info_id = PInfo.id
                ) AS FirstPhoto
                ,users.profile_photo_path
            FROM RE_V_GET_ALL_ACTIVE_PROPERTY_POST_WITH_USERNAME AS PPost
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
                AND PPost.is_available = 1
                AND PInfo.unit_category = @p_UnitCategory
                AND (@p_City IS NULL OR PInfo.city = @p_City)
                AND (@p_RentalPrice IS NULL OR PInfo.rental_price = @p_RentalPrice)
            INNER JOIN users
                ON users.id = PPost.user_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_ALL_PROPERTY_POST_BASED_ON_FILTER_SEARCH");
    }
};
