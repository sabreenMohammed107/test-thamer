<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataCaseMemberTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_members_tasks', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('regulation_id')->nullable();
            $table->foreign('regulation_id')->references('id')->on('interceptions_regulations');

            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->foreign('attachment_id')->references('id')->on('attachments');

            $table->unsignedBigInteger('diary_id')->nullable();
            $table->foreign('diary_id')->references('id')->on('diaries');

            $table->unsignedBigInteger('letter_id')->nullable();
            $table->foreign('letter_id')->references('id')->on('letters');

            $table->unsignedBigInteger('petition_id')->nullable();
            $table->foreign('petition_id')->references('id')->on('petitions');

            $table->unsignedBigInteger('transfer_case_id')->nullable();
            $table->foreign('transfer_case_id')->references('id')->on('users');

            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sessions');
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
