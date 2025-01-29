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
        // -- DEFINE STORED PROCEDURE TO GET ALL THE ROOMMATES TENANTS POSTS BASED ON THE USER ID
        DB::statement("
            CREATE PROC RE_SP_GET_ALL_ROOMMATES_TENANTS_POSTS_BY_USERID
                @p_UserId BIGINT
            AS
            SELECT
                *
            FROM RE_V_GET_ACTIVE_ROOMMATE_TENANT_POST AS RoommateTenant
            WHERE RoommateTenant.user_id = @p_UserId
            ORDER BY RoommateTenant.updated_at DESC
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_ALL_ROOMMATES_TENANTS_POSTS_BY_USERID");
    }
};
