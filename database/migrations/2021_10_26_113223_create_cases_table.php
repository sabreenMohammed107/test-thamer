<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->datetime('start_date')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('client_id')->nullable();
            $table->foreignId('opponent_id')->nullable();
            $table->string('file_no')->nullable();
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('current_resposible_id')->nullable();
            $table->foreignId('court_id')->nullable();
            $table->string('exec_dision_no')->nullable();
            $table->integer('court_case_no')->nullable();
            $table->text('client_low_description')->nullable();
            $table->foreignId('case_type_id')->nullable();
            $table->string('police_escalation_no')->nullable();
            $table->integer('fees_type')->nullable();
            $table->decimal('case_fees', 14, 2)->nullable();
            $table->integer('public_prosecutor_case_no')->nullable();
            $table->string('circle_no')->nullable();
            $table->string('expert_name')->nullable();
            $table->foreignId('case_status_id')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
