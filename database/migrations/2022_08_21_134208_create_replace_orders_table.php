<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplaceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replace_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('replaceInvoiceType');
            $table->string('replaceNumberInvoice', 8);
            $table->string('replaceCustomerType');
            $table->string('replaceCustomerCodeInvoice');
            $table->string('replaceCustomerNameInvoice');
            $table->string('replaceCustomerPhoneNumberInvoice');
            $table->string('replaceTotalItems');
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
        Schema::dropIfExists('replace_orders');
    }
}
