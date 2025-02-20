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
        // -- Define a stored procedure to retrieve a user's info based on the user id and user based on the email
        DB::statement("
            CREATE PROC RE_SP_GET_USER_INFO_BY_ID_AND_USER_BY_EMAIL
                @p_UserId BIGINT = NULL
                ,@p_Email NVARCHAR(255) = NULL
            AS
            IF @p_UserId IS NOT NULL
                -- Get user info based on the user id
                BEGIN
                    SELECT
                        UsersInfo.*
                    FROM RE_V_GET_ALL_USER_INFO_WITH_RATINGS AS UsersInfo
                    WHERE UsersInfo.id = @p_UserId
                END
            ELSE
                -- Get user based on the email
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
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_USER_INFO_BY_ID_AND_USER_BY_EMAIL");
    }
};
