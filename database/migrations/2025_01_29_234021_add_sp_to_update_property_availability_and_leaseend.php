<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE PROCEDURE RE_SP_UPDATE_PROPERTY_AVAILABILITY_ENDLEASE
                @p_landlordId INT
                ,@p_PostId INT
                ,@p_IsAvailable BIT
                ,@p_leaseEnd DATETIME
            AS
            UPDATE 
                reviews
            SET 
                lease_end = @p_leaseEnd
            WHERE
                review_by_user_id = @p_landlordId
                AND review_to_user_id = @p_landlordId
                AND property_post_id = @p_PostId

            UPDATE
                property_posts
            SET
                is_available = @p_IsAvailable
            WHERE
                id = @p_PostId
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_UPDATE_AVAILABILITY_ENDLEASE");
    }
};