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
        // -- DEFINE STORED PROCEDURE TO INSERT PROPERTY POST AND ITS PROPERTY INFOS AND UNIT PHOTOS
        DB::statement("
            CREATE PROC RE_SP_INSERT_PROPERTY_POST_WITH_RELATIONS
                @p_City NVARCHAR(255)
                ,@p_Barangay NVARCHAR(255)
                ,@p_UnitCategory NVARCHAR(255)
                ,@p_RentalPrice NVARCHAR(255)
                ,@p_MaxOccupancy NVARCHAR(255)
                ,@p_Description NVARCHAR(MAX)
                ,@p_PhotoPaths NVARCHAR(MAX)
                ,@p_UserId BIGINT
            AS
            -- Variable Declaration
            DECLARE @v_LastPropertyInfoId INT;

            -- Insert Property Info
            INSERT INTO property_infos(city
                ,barangay
                ,unit_category
                ,rental_price
                ,max_occupancy
                ,description)
            VALUES(@p_City
                ,@p_Barangay
                ,@p_UnitCategory
                ,@p_RentalPrice
                ,@p_MaxOccupancy
                ,@p_Description)

            -- Get the id of the last property info created
            SET @v_LastPropertyInfoId = SCOPE_IDENTITY();

            -- Make the @p_PhotoPaths as a JSON format
            SET @p_PhotoPaths = CONCAT('[', @p_PhotoPaths, ']');

            -- Insert all the PhotoPaths into the unit photos table
            INSERT INTO unit_photos (property_info_id, photo_path)
            SELECT @v_LastPropertyInfoId, value
            FROM OPENJSON(@p_PhotoPaths)

            -- Insert Property Post
            INSERT INTO property_posts(property_info_id, user_id)
            VALUES(@v_LastPropertyInfoId, @p_UserId)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_INSERT_PROPERTY_POST_WITH_RELATIONS");
    }
};
