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
        Schema::create('find_roommate_or_tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Foreign key referencing users(id)
            $table->dateTime('date_posted');
            $table->string('city');
            $table->string('barangay');
            $table->text('description');
            $table->boolean('is_already_found')->default(false);
            $table->string('category_finding');
            $table->timestamps();
        });

        // Create stored procedure
        // Define stored procedure to get all finding posts with user
        DB::statement("
            CREATE PROCEDURE GetAllFindingPostsWithUser
            AS
            BEGIN
                SELECT find_post.*, users.firstname, users.lastname
                FROM find_roommate_or_tenants AS find_post
                INNER JOIN users
                    ON find_post.user_id = users.id
                WHERE find_post.is_already_found = 0
                ORDER BY find_post.date_posted DESC
            END
        ");

        // Define stored procedure to insert a data into find_roommate_or_tenants table
        DB::statement("
            CREATE PROCEDURE StoreSearchingPost
                @userId BIGINT
                ,@datePosted DATETIME
                ,@city NVARCHAR(255)
                ,@barangay NVARCHAR(255)
                ,@description NVARCHAR(MAX)
                ,@categoryFinding NVARCHAR(255)
            AS
            BEGIN
                INSERT INTO find_roommate_or_tenants (user_id
                    ,date_posted
                    ,city
                    ,barangay
                    ,description
                    ,category_finding)
                VALUES (@userId
                    ,@datePosted
                    ,@city
                    ,@barangay
                    ,@description
                    ,@categoryFinding)
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the stored procedure
        DB::statement("DROP PROCEDURE IF EXISTS AuthenticatedUserInfo");
        DB::statement("DROP PROCEDURE IF EXISTS StoreSearchingPost");

        Schema::dropIfExists('find_roommate_or_tenants');
    }
};
