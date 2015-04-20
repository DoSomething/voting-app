<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_email_unique');
            $table->index('email');
            $table->dropColumn('remember_token');
            $table->string('first_name')->after('id');
            $table->string('phone')->after('email')->index()->nullable();
            $table->date('birthdate')->after('phone');
        });
        // Changing a field to nullable cannot be done with the schema creation syntax.
        DB::statement('ALTER TABLE `users` MODIFY `email` varchar(255) NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_email_index');
            $table->unique('email');
            $table->rememberToken();
            $table->dropColumn('first_name');
            $table->dropColumn('phone');
            $table->dropColumn('birthdate');
        });
        DB::statement('ALTER TABLE `users` MODIFY `email` varchar(255);');
    }
}
