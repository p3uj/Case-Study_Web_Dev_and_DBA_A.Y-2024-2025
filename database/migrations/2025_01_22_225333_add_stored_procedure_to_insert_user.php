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
            CREATE PROCEDURE SP_INSERT_USER
                @u_role NVARCHAR(255),
                @u_firstname NVARCHAR(255),
                @u_lastname NVARCHAR(255),
                @u_city NVARCHAR(255),
                @u_email NVARCHAR(255),
                @u_password NVARCHAR(255),
                @u_profile_photo_path NVARCHAR(255),
                @u_bio NVARCHAR(MAX)
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
                    @u_role,
                    @u_firstname,
                    @u_lastname,
                    @u_city,
                    @u_email,
                    @u_password,
                    @u_profile_photo_path,
                    @u_bio
                );
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the stored procedure
        DB::statement("DROP PROCEDURE IF EXISTS SP_INSERT_USER");
    }
};
