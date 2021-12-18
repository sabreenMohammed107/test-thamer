<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterceptionsRegulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interceptions_regulations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->nullable();
            $table->foreignId('member_id')->nullable();
            $table->datetime('regulation_date')->nullable();
            $table->text('facts')->nullable();
            $table->text('defenses')->nullable();
            $table->text('requirements')->nullable();
            $table->text('text')->nullable();
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
        Schema::dropIfExists('interceptions_regulations');
    }
}
