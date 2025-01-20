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
            $table->string('city');
            $table->string('barangay');
            $table->text('description');
            $table->boolean('is_already_found')->default(false);
            $table->string('search_categories');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->boolean('is_deleted')->default(false);
        });

        // Create stored procedure
        // Define stored procedure to get all finding posts with user
        DB::statement("
            CREATE PROCEDURE GetAllRoommateTenantPostsWithUser
            AS
            BEGIN
                SELECT find_post.*, users.firstname, users.lastname
                FROM find_roommate_or_tenants AS find_post
                INNER JOIN users
                    ON find_post.user_id = users.id
                WHERE find_post.is_deleted = 0 AND find_post.is_already_found = 0
                ORDER BY find_post.updated_at DESC
            END
        ");

        // Define stored procedure to insert a data into find_roommate_or_tenants table
        DB::statement("
            CREATE PROCEDURE StoreRoommateTenantPost
                @userId BIGINT
                ,@city NVARCHAR(255)
                ,@barangay NVARCHAR(255)
                ,@description NVARCHAR(MAX)
                ,@searchCategory NVARCHAR(255)
            AS
            BEGIN
                INSERT INTO find_roommate_or_tenants (user_id
                    ,city
                    ,barangay
                    ,description
                    ,search_categories)
                VALUES (@userId
                    ,@city
                    ,@barangay
                    ,@description
                    ,@searchCategory)
            END
        ");

        // Define stored procedure to get 'find_roommate_or_tenant' post based on the user id
        DB::statement("
            CREATE PROCEDURE GetAllRoommateTenantPostsByUserId (@userId BIGINT)
            AS
            BEGIN
                SELECT * FROM find_roommate_or_tenants
                WHERE user_id = @userId AND is_deleted = 0
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the stored procedure
        DB::statement("DROP PROCEDURE IF EXISTS GetAllRoommateTenantPostsWithUser");
        DB::statement("DROP PROCEDURE IF EXISTS StoreRoommateTenantPost");
        DB::statement("DROP PROCEDURE IF EXISTS GetAllRoommateTenantPostsByUserId");

        Schema::dropIfExists('find_roommate_or_tenants');
    }
};
