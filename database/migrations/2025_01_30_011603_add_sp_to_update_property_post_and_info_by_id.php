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
        // -- DEFINE STORED PROCEDURE TO UPDATE THE PROPERTY INFO AND PROPERTY POST
        DB::statement("
            CREATE PROC RE_SP_UPDATE_PROPERTY_POST_AND_INFO_BY_ID
                @p_PropertyInfoId BIGINT = NULL
                ,@p_PropertyPostId BIGINT
                ,@p_City VARCHAR(255) = NULL
                ,@p_Barangay VARCHAR(255) = NULL
                ,@p_UnitCategory VARCHAR(255) = NULL
                ,@p_RentalPrice DECIMAL(10, 2) = NULL
                ,@p_MaxOccupancy INT = NULL
                ,@p_Description VARCHAR(MAX) = NULL
                ,@p_IsAvailable BIT = NULL
                ,@p_IsDeleted BIT = NULL
            AS
            IF (@p_IsAvailable IS NULL AND @p_IsDeleted IS NULL)
                BEGIN
                    UPDATE property_infos
                    SET
                        city = CASE WHEN @p_City IS NOT NULL THEN @p_City ELSE city END
                        ,barangay = CASE WHEN @p_Barangay IS NOT NULL THEN @p_Barangay ELSE barangay END
                        ,unit_category = CASE WHEN @p_UnitCategory IS NOT NULL THEN @p_UnitCategory ELSE unit_category END
                        ,rental_price = CASE WHEN @p_RentalPrice IS NOT NULL THEN @p_RentalPrice ELSE rental_price END
                        ,max_occupancy = CASE WHEN @p_MaxOccupancy IS NOT NULL THEN @p_MaxOccupancy ELSE max_occupancy END
                        ,description = CASE WHEN @p_Description IS NOT NULL THEN @p_Description ELSE description END
                        ,updated_at = GETDATE()
                    WHERE id = @p_PropertyInfoId

                    UPDATE property_posts
                    SET updated_at = GETDATE()
                    WHERE id = @p_PropertyPostId
                END
            ELSE IF @p_IsAvailable IS NOT NULL
                BEGIN
                    UPDATE property_posts
                    SET
                        is_available = @p_IsAvailable
                        ,updated_at = GETDATE()
                    WHERE id = @p_PropertyPostId
                END
            ELSE IF @p_IsDeleted IS NOT NULL
                BEGIN
                    UPDATE property_posts
                    SET
                        is_deleted = @p_IsDeleted
                        ,updated_at = GETDATE()
                    WHERE id = @p_PropertyPostId
                END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_UPDATE_PROPERTY_POST_AND_INFO_BY_ID");
    }
};
