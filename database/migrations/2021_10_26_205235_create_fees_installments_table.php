<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->nullable();
            $table->integer('installment_no')->nullable();
            $table->datetime('installment_date')->nullable();
            $table->decimal('pay_amount', 10, 2);
            $table->integer('paid')->nullable();
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
        Schema::dropIfExists('fees_installments');
    }
}
