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

        // -- DEFINE STORED PROCEDURE TO GET USER BY NAME
        DB::statement("
            CREATE PROC RE_SP_GET_USER_BY_NAME
                @p_UserName NVARCHAR(255)
            AS
            SELECT
                *
            FROM RE_V_GET_ALL_USER_INFO_WITH_RATINGS AS UserInfo
            WHERE LOWER(CONCAT(firstname, ' ', lastname)) LIKE '%' + LOWER(@p_UserName) + '%'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_USER_BY_NAME");
    }
};
