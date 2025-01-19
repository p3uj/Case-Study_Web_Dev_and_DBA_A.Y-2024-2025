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
        Schema::create('property_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_info_id')->constrained('property_infos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('date_posted');
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });

        // Create stored procedure
        // Define stored procedure to get all the property post of the authenticated user
        DB::statement("
            CREATE PROCEDURE GetAuthUserPropertyPosts
                @userId BIGINT
            AS
            BEGIN
                SELECT
                    PPost.*
                    ,PInfo.*
                    ,COALESCE(ReviewRating.Rating, 0) AS Rating
                FROM
                    property_posts AS PPost
                INNER JOIN
                    users ON users.id = PPost.user_id
                INNER JOIN
                    property_infos AS PInfo ON PInfo.id = PPost.property_info_id
                LEFT JOIN (
                    SELECT
                        property_post_id
                        ,AVG(rating) AS Rating
                    FROM reviews
                    GROUP BY property_post_id
                ) AS ReviewRating ON ReviewRating.property_post_id = PPost.id
                WHERE users.id = @userId
                ORDER BY PPost.date_posted DESC
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the stored procedure
        DB::statement("DROP PROCEDURE IF EXISTS GetAuthUserPropertyPosts");
    }
};
