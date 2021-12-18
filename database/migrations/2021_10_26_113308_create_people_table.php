<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('preson_type')->nullable();
            $table->integer('person_company_type')->nullable();
            $table->integer('identity_type_id')->nullable();
            $table->string('identity_no')->nullable();
            $table->foreignId('nationality_id')->nullable();
            $table->datetime('birth_date')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
             $table->string('email')->nullable();
             $table->string('fax')->nullable();
             $table->string('job')->nullable();
             $table->string('address')->nullable();
             $table->string('attatchments')->nullable();
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
        Schema::dropIfExists('people');
    }
}
