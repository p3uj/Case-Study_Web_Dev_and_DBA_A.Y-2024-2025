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
        //
        // Drop the old stored procedure if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_NEWLY_CREATED_USER");
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_USER_RATING_AND_NEWLY_USERS");

        //-- Recreate the stored procedure to get user's ratings and newly user
        DB::statement("
            CREATE PROC RE_SP_GET_USER_RATING_AND_NEWLY_USERS
                @p_UserId BIGINT = NULL
                ,@p_Email NVARCHAR(255) = NULL
            AS
            IF @p_UserId IS NOT NULL
                -- Get user's rating based on the user id
                BEGIN
                    SELECT
                        UsersInfo.Rating
                    FROM RE_V_GET_ALL_USER_INFO_WITH_RATINGS AS UsersInfo
                    WHERE UsersInfo.id = @p_UserId
                END
            ELSE
                -- Get newly created user based on the email
                BEGIN
                    SELECT
                        id AS user_id
                        ,email
                        ,password
                        ,role
                    FROM users
                    WHERE email = @p_email;
                END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the stored procedure if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_ALL_PROPERTY_POST_BASED_ON_FILTER_SEARCH");
    }
};
