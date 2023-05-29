<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('order_number');
            $table->string('user_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('amount');
            $table->string('description')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('street_line1')->nullable();
            $table->string('street_line2')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_channel')->nullable();
            $table->string('payment_destination')->nullable();
            $table->string('payment_url')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('adjusted_received_amount')->nullable();
            $table->string('fees_paid_amount')->nullable();
            $table->string('bank_code')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->string('status')->nullable()->default('UNPAID');
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
};
