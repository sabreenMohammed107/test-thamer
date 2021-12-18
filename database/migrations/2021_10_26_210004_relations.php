<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //  This is Realations for the contracts Table ..
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('contract_types');
            $table->foreign('first_side_id')->references('id')->on('people');
            $table->foreign('second_side_id')->references('id')->on('people');
        });

        //  This is Realations for the cases Table ..
        Schema::table('cases', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('people');
            $table->foreign('opponent_id')->references('id')->on('people');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('current_resposible_id')->references('id')->on('users');
            $table->foreign('court_id')->references('id')->on('courts');
            $table->foreign('case_type_id')->references('id')->on('case_types');
            $table->foreign('case_status_id')->references('id')->on('statuses');
        });

        //  This is Realations for the case_logs Table ..
        Schema::table('case_logs', function (Blueprint $table) {
            $table->foreign('case_id')->references('id')->on('cases');
            $table->foreign('log_type_id')->references('id')->on('log_types');
            $table->foreign('log_status_id')->references('id')->on('statuses');
        });

        //  This is Realations for the people Table ..
        Schema::table('people', function (Blueprint $table) {
            $table->foreign('nationality_id')->references('id')->on('nationalities');
            $table->foreign('city_id')->references('id')->on('cities');

        });
        //  This is Realations for the branches Table ..
        Schema::table('branches', function (Blueprint $table) {
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('cities');
        });

        //  This is Realations for the case_members Table ..
        Schema::table('case_members', function (Blueprint $table) {
            $table->foreign('case_id')->references('id')->on('cases');
            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('controlled_by')->references('id')->on('users');
        });

        //  This is Realations for the letters Table ..
        Schema::table('letters', function (Blueprint $table) {
            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('case_id')->references('id')->on('cases');
        });
        //  This is Realations for the petitions Table ..
        Schema::table('petitions', function (Blueprint $table) {
            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('case_id')->references('id')->on('cases');
        });

        //  This is Realations for the case_members_tasks Table ..
        Schema::table('case_members_tasks', function (Blueprint $table) {
            $table->foreign('case_id')->references('id')->on('cases');
            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('task_type_id')->references('id')->on('task_types');
            $table->foreign('task_status_id')->references('id')->on('task_statuses');
        });

             //  This is Realations for the interceptions_regulations Table ..
        Schema::table('interceptions_regulations', function (Blueprint $table) {
            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('case_id')->references('id')->on('cases');
        });
              //  This is Realations for the sessions Table ..
              Schema::table('sessions', function (Blueprint $table) {
                $table->foreign('member_id')->references('id')->on('users');
                $table->foreign('case_id')->references('id')->on('cases');
            });
             //  This is Realations for the diaries Table ..
             Schema::table('diaries', function (Blueprint $table) {
                $table->foreign('member_id')->references('id')->on('users');
                $table->foreign('case_id')->references('id')->on('cases');
            });


             //  This is Realations for the fees_installments Table ..
             Schema::table('fees_installments', function (Blueprint $table) {
                $table->foreign('controlled_by')->references('id')->on('users');
                $table->foreign('case_id')->references('id')->on('cases');
            });

             //  This is Realations for the attachments Table ..
             Schema::table('attachments', function (Blueprint $table) {
                $table->foreign('case_id')->references('id')->on('cases');
            });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
