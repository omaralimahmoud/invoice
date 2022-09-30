<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplaceOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replace_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('replace_order_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->string('replaceQuantityInvoice',255);
            $table->text('replaceNotesInvoice')->nullable();
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
        Schema::dropIfExists('replace_order_details');
    }
}
