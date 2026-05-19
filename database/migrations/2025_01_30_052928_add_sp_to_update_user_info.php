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
        //-- DEFINE STORED PROCEDURE TO UPDATE THE USER INFO BASED ON THE ID
        DB::statement("
            CREATE PROC RE_SP_UPDATE_USERINFO
                @p_Id BIGINT
                ,@p_Firstname NVARCHAR(255) = NULL
                ,@p_Lastname NVARCHAR(255) = NULL
                ,@p_City NVARCHAR(255) = NULL
                ,@p_Bio NVARCHAR(MAX) = NULL
                ,@p_ProfilePhotoPath NVARCHAR(255) = NULL
            AS
            UPDATE RE_V_GET_ALL_USER_INFO_WITH_RATINGS
            SET
                firstname = CASE WHEN @p_Firstname IS NOT NULL THEN @p_Firstname ELSE firstname END
                ,lastname = CASE WHEN @p_Lastname IS NOT NULL THEN @p_Lastname ELSE lastname END
                ,city = CASE WHEN @p_City IS NOT NULL THEN @p_City ELSE city END
                ,bio = CASE WHEN @p_Bio IS NOT NULL THEN @p_Bio ELSE bio END
                ,profile_photo_path = CASE WHEN @p_ProfilePhotoPath IS NOT NULL THEN @p_ProfilePhotoPath ELSE profile_photo_path END
                ,updated_at = GETDATE()
            WHERE id = @p_Id
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
