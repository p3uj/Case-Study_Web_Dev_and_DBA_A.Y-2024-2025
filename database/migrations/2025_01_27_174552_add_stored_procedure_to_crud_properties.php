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
        DB::statement("
            CREATE PROCEDURE RE_SP_GET_ALL_USER_PROPERTY
                @p_UserId BIGINT
            AS
            BEGIN
                SELECT
                    PPost.id
                    ,(
                        SELECT TOP 1 photo_path
                        FROM unit_photos
                        WHERE property_info_id = PInfo.id
                    ) AS FirstPhoto
                    ,PInfo.city
                    ,PInfo.barangay
                FROM
                    property_infos AS PInfo
                INNER JOIN property_posts AS PPost
                    ON PInfo.id = PPost.property_info_id
                WHERE
                    PPost.user_id = @p_UserId
                    AND PPost.is_deleted = 0
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_ALL_USER_PROPERTY");
    }
};