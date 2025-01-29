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
        // -- GET ALL UNIT PHOTO PATHS BASED ON THE PROPERTY INFO ID
        DB::statement("
            CREATE PROC RE_SP_GET_ALL_ACTIVE_PHOTOS_BY_PROPERTY_INFO_ID
                @p_PropertyInfoId BIGINT
            AS
            SELECT
                unit_photos.photo_path
            FROM unit_photos
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = unit_photos.property_info_id
            WHERE PInfo.id = @p_PropertyInfoId AND unit_photos.is_deleted = 0
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_ALL_ACTIVE_PHOTOS_BY_PROPERTY_INFO_ID");
    }
};
