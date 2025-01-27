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
        // Drop view if exists
        DB::statement("DROP VIEW IF EXISTS RE_V_GET_ALL_USER_INFO_WITH_RATINGS");

        //-- Define stored procedure to get all the property posts with ratings and 1 unit photo based on the user id
        // -- Get all property post details including ratings, user name and its profile photo
        DB::statement("
            CREATE VIEW RE_V_GET_ALL_USER_INFO_WITH_RATINGS
            AS
            SELECT
                users.*
                ,(
                    SELECT
                        COALESCE(AVG(rating), 0)
                    FROM reviews
                    WHERE review_to_user_id = users.id
                ) AS Rating
            FROM users
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view if it exists
        DB::statement("DROP PROCEDURE IF EXISTS RE_V_GET_ALL_USER_INFO_WITH_RATINGS");
    }
};
