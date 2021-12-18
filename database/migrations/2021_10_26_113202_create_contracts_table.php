<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->datetime('contract_date')->nullable();
            $table->foreignId('type_id')->nullable();
            $table->foreignId('first_side_id')->nullable();
            $table->foreignId('second_side_id')->nullable();
            $table->longText('intro')->nullable();
            $table->longText('contract_items')->nullable();
            $table->longText('attatchment')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
