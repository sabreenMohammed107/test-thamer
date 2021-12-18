<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseMembersTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_members_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->nullable();
            $table->foreignId('member_id')->nullable();
            $table->text('task_description')->nullable();
            $table->foreignId('task_type_id')->nullable();
            $table->datetime('task_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->foreignId('task_status_id')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_members_tasks');
    }
}
