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
        // -- DEFINE VIEW TO GET ALL THE ACTIVE PROPERTY POST WITH USER'S NAME
        DB::statement("
            CREATE VIEW RE_V_GET_ALL_ACTIVE_PROPERTY_POST_WITH_USERNAME
            AS
            SELECT
                PPost.*
                ,PostedByUser.firstname + ' ' + PostedByUser.lastname AS UserName
            FROM property_posts AS PPost
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
        DB::statement("DROP VIEW IF EXISTS RE_V_GET_ALL_ACTIVE_PROPERTY_POST_WITH_USERNAME");
    }
};
