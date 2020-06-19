<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('status', 20);
        });

        Schema::table('requests', function ($table) {
            $table->unsignedTinyInteger('status_id')->after('user_id')->default(3);

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function($table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn(['status_id']);
        });

        Schema::dropIfExists('statuses');
    }
}
