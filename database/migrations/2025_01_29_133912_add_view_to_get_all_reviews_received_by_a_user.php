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
        //-- DEFINE VIEW TO GET ALL USERS INFO WITH THE REVIEWS RECEIVED BY ALL USERS
        DB::statement("
            CREATE VIEW RE_V_GET_ALL_USER_INFO_WITH_RATINGS
            AS
            SELECT
                users.*
                ,(
                    SELECT
                        COALESCE(ROUND(CAST(AVG(CAST(rating AS DECIMAL(10, 2))) AS DECIMAL(10, 2)), 2), 0) AS Rating
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
        DB::statement("DROP VIEW IF EXISTS RE_V_GET_ALL_USER_INFO_WITH_RATINGS");
    }
};
