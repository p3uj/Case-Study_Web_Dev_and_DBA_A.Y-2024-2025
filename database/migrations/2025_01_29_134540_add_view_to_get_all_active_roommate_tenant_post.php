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
        // -- DEFINE VIEW TO GET ALL THE ACTIVE ROOMMATE TENANT POST
        DB::statement("
            CREATE VIEW RE_V_GET_ACTIVE_ROOMMATE_TENANT_POST
            AS
            SELECT
                RoommateTenant.*
                ,users.firstname + ' ' + users.lastname AS UserName
                ,users.profile_photo_path
            FROM find_roommate_or_tenants AS RoommateTenant
            INNER JOIN users
                ON users.id = RoommateTenant.user_id
            WHERE
                RoommateTenant.is_deleted = 0
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_V_GET_ACTIVE_ROOMMATE_TENANT_POST");
    }
};
