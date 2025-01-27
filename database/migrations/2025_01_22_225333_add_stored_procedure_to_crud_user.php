<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create stored procedure
        DB::statement("
            CREATE PROCEDURE RE_SP_INSERT_USER
                @p_role NVARCHAR(255),
                @p_firstname NVARCHAR(255),
                @p_lastname NVARCHAR(255),
                @p_city NVARCHAR(255),
                @p_email NVARCHAR(255),
                @p_password NVARCHAR(255),
                @p_profile_photo_path NVARCHAR(255),
                @p_bio NVARCHAR(MAX)
            AS
            BEGIN
                INSERT INTO users (
                    role,
                    firstname,
                    lastname,
                    city,
                    email,
                    password,
                    profile_photo_path,
                    bio
                ) VALUES (
                    @p_role,
                    @p_firstname,
                    @p_lastname,
                    @p_city,
                    @p_email,
                    @p_password,
                    @p_profile_photo_path,
                    @p_bio
                );
            END
        ");

        DB::statement("
            CREATE PROCEDURE RE_SP_GET_NEWLY_CREATED_USER
                @p_email NVARCHAR(255)
            AS
            BEGIN
                SELECT
                    id AS user_id
                    ,email
                    ,password
                    ,role
                FROM
                    users
                WHERE
                    email = @p_email;
            END
        ");

        DB::statement("
            CREATE PROCEDURE RE_SP_GET_ALL_TENANT
            AS
            BEGIN
                SELECT
                    U.id
                    ,U.firstname
                    ,U.lastname
                    ,U.profile_photo_path
                FROM
                    users AS U
                WHERE
                    U.role = 'Tenant'
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the stored procedure
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_INSERT_USER");
        DB::statement("DROP PROCEDURE IF EXISTS RE_SP_GET_NEWLY_CREATED_USER");
    }
};
