<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_logs', function (Blueprint $table) {
            $table->id();
            $table->datetime('case_date')->nullable();
            $table->foreignId('case_id')->nullable();
            $table->foreignId('log_type_id')->nullable();
            $table->foreignId('log_status_id')->nullable();
            $table->text('log_text')->nullable();
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
        Schema::dropIfExists('case_logs');
    }
}
