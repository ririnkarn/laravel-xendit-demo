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
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->string('disbursement_code')->nullable();
            $table->string('user_id')->nullable();
            $table->string('disbursement_id')->nullable();
            $table->string('bank_code')->nullable();
            $table->decimal('amount', 20, 2)->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable()->default('PENDING');
            $table->dateTime('completed_at')->nullable();
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
        Schema::dropIfExists('disbursements');
    }
};
