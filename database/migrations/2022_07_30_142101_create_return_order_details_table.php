<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_order_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->string('returnQuantityInvoice',255);
            $table->string('returnUnitSaleBriceInvoice',255);
            $table->text('returnNotesInvoice')->nullable();
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
        Schema::dropIfExists('return_order_details');
    }
}
