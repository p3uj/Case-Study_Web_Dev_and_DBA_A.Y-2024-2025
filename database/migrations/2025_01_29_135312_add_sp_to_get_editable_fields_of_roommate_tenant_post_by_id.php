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
        // -- DEFINE STORED PROCEDURE TO GET CITY, BARANGAY, AND DESCRIPTION OF THE ROOMMATE TENANT POST BY ID
        DB::statement("
            CREATE PROC RE_SP_GET_ROOMMATE_TENANT_BY_ID
                @p_Id BIGINT
            AS
            SELECT
                RoommateTenant.city
                ,RoommateTenant.barangay
                ,RoommateTenant.description
            FROM RE_V_GET_ACTIVE_ROOMMATE_TENANT_POST AS RoommateTenant
            WHERE RoommateTenant.id = @p_Id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_ROOMMATE_TENANT_BY_ID");
    }
};
