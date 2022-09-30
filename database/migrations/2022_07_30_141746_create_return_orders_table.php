<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('returnInvoiceType');
            $table->string('returnNumberInvoice', 8);
            $table->string('returnCustomerType');
            $table->string('returnCustomerCodeInvoice');
            $table->string('returnCustomerNameInvoice');
            $table->string('returnCustomerPhoneNumberInvoice');
            $table->string('returnDiscountBercentageInvoice',255)->nullable();
            $table->string('returnRemoveDecimal')->nullable();
            $table->string('returnNetInvoice',255);
            $table->string('returnTotalItems');
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
        Schema::dropIfExists('return_orders');
    }
}
