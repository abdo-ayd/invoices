<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number');
            $table->date('invoice_Date')->nullable();
            $table->date('Due_date')->nullable();
            $table->string('product');
            $table->integer('section_id')->unsigned();


            $table->decimal('Amount_collection')->nullable();;
            $table->decimal('Amount_Commission');
            $table->decimal('Discount');
            $table->decimal('Value_VAT');
            $table->string('Rate_VAT');
            $table->decimal('Total');
            $table->string('Status');
            $table->integer('Value_Status');
            $table->text('note')->nullable();
            $table->date('Payment_Date')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
