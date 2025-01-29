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
            CREATE PROC RE_SP_GET_FEATURED_PROPERTIES
            AS
            SELECT TOP 6
                PPost.id AS Post,
                PInfo.id AS Info,
                UP.photo_path
            FROM property_posts AS PPost
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            LEFT JOIN unit_photos AS UP
                ON PInfo.id = UP.property_info_id
            WHERE UP.id = (
                SELECT TOP 1 id
                FROM unit_photos
                WHERE property_info_id = PInfo.id)
            ORDER BY NEWID()
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_FEATURED_PROPERTIES");
    }
};
