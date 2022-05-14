<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTablePhone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone')->nullable()->after('company');
                $table->boolean('is_active')->default(0)->after('phone');
            });

            DB::statement('UPDATE `users` SET `is_active` = 1');
            DB::statement('ALTER TABLE users ADD FULLTEXT fulltext_index (name, email)');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['phone', 'is_active']);
            });
        }

    }
}
