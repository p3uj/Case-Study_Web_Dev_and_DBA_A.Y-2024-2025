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
        // -- DEFINE STORED PROCEDURE TO INSERT ROOMMATE TENANT POST
        DB::statement("
            CREATE PROC RE_SP_INSERT_ROOMMATE_TENANT_POST
                @p_UserId BIGINT
                ,@p_City NVARCHAR(255)
                ,@p_Barangay NVARCHAR(255)
                ,@p_Description NVARCHAR(MAX)
                ,@p_SearchCategory NVARCHAR(255)
            AS
            INSERT INTO find_roommate_or_tenants (
                user_id
                ,city
                ,barangay
                ,description
                ,search_categories
            )
            VALUES (
                @p_UserId
                ,@p_City
                ,@p_Barangay
                ,@p_Description
                ,@p_SearchCategory
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_INSERT_ROOMMATE_TENANT_POST");
    }
};
