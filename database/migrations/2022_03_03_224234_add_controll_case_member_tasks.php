<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddControllCaseMemberTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_members_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('control_by_id')->nullable();
            $table->foreign('control_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('case_members_tasks', function (Blueprint $table) {
            //
        });
    }
}
