<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->nullable();
            $table->foreignId('member_id')->nullable();
            $table->integer('incharge_type')->nullable();
            $table->datetime('incharge_date')->nullable();
            $table->integer('active')->default(1);
            $table->foreignId('controlled_by')->nullable();
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
        Schema::dropIfExists('case_members');
    }
}
