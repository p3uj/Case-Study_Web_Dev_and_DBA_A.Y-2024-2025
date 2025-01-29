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
        // -- DEFINE STORED PROCEDURE TO UPDATE THE ROOMMATE TENANT POST
        DB::statement("
            CREATE PROC RE_UPDATE_ROOMMATE_TENANT_POST
                @p_Id BIGINT
                ,@p_City VARCHAR(255) = NULL
                ,@p_Barangay VARCHAR(255) = NULL
                ,@p_Description VARCHAR(MAX) = NULL
                ,@p_IsAlreadyFound BIT = NULL
                ,@p_IsDeleted BIT = NULL
            AS
            UPDATE RE_V_GET_ACTIVE_ROOMMATE_TENANT_POST
            SET
                city = CASE WHEN @p_City IS NOT NULL THEN @p_City ELSE city END
                ,barangay = CASE WHEN @p_Barangay IS NOT NULL THEN @p_Barangay ELSE barangay END
                ,description = CASE WHEN @p_Description IS NOT NULL THEN @p_Description ELSE description END
                ,is_already_found = CASE WHEN @p_IsAlreadyFound IS NOT NULL THEN @p_IsAlreadyFound ELSE is_already_found END
                ,updated_at = GETDATE()
                ,is_deleted = CASE WHEN @p_IsDeleted IS NOT NULL THEN @p_IsDeleted ELSE is_deleted END
            WHERE id = @p_Id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_UPDATE_ROOMMATE_TENANT_POST");
    }
};
