<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('invoiceType');
            $table->string('numberInvoice', 8);
            $table->string('customerType');
            $table->string('discountBercentageInvoice',255)->nullable();
            $table->string('netInvoice',255);
            $table->string('customerCodeInvoice');
            $table->string('customerNameInvoice');
            $table->string('CustomerPhoneNumberInvoice');
            $table->string('removeDecimal')->nullable();
            $table->string('totalItems');
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
        Schema::dropIfExists('orders');
    }
}
