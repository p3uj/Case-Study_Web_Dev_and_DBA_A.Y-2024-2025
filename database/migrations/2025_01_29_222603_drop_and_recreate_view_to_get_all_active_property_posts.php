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
        // Drop old view
        DB::statement('DROP VIEW IF EXISTS RE_V_GET_ALL_ACTIVE_PROPERTY_POST_WITH_USERNAME');

        // -- DEFINE VIEW TO GET ALL THE ACTIVE PROPERTY POST WITH USER'S NAME
        // Recreate updated view
        DB::statement("
            CREATE VIEW RE_V_GET_ALL_ACTIVE_PROPERTY_POST_WITH_USERNAME
            AS
            SELECT
                PPost.id
                ,PPost.property_info_id
                ,PPost.user_id
                ,PPost.is_available
                ,PPost.updated_at AS property_post_updated_at
                ,PPost.is_deleted
                ,PInfo.city
                ,PInfo.barangay
                ,PInfo.unit_category
                ,PInfo.rental_price
                ,PInfo.max_occupancy
                ,PInfo.description
                ,PInfo.updated_at AS property_info_updated_at
                ,PostedByUser.firstname + ' ' + PostedByUser.lastname AS UserName
            FROM property_posts AS PPost
            INNER JOIN property_infos AS PInfo
                ON PInfo.id = PPost.property_info_id
            INNER JOIN users AS PostedByUser
                ON PostedByUser.id = PPost.user_id
            WHERE PPost.is_deleted = 0
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_V_GET_ALL_ACTIVE_PROPERTY_POST_WITH_USERNAME");
    }
};
