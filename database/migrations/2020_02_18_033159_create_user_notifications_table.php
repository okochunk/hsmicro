<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');

            $table->string('title');
            $table->string('description');

            $table->boolean('is_active')->default(1);

            $table->timestamp('start_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_date')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        DB::statement('ALTER TABLE user_notifications ADD FULLTEXT fulltext_index (title)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notifications');
    }
}
