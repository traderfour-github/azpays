<?php

use App\Enums\Payment\PaymentStatus;
use App\Models\Payment;
use App\Models\User;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('token')->unique();
            $table->foreignUuid('merchant_id')->constrained('merchants')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('payee_id');
            $table->uuid('payer_id')->nullable();
            $table->float('amount', 36, 18);
            $table->smallInteger('currency')->default(0);
            $table->string('factor')->nullable();
            $table->string('description')->nullable();
//            $table->json('developer')->nullable(); @TODO: Add on meta table
//            $table->string('valid_card',20)->nullable(); @TODO: Add on meta table
            $table->timestamp(Payment::STARTED_AT, 6)->nullable();
            $table->timestamp(Payment::VERIFIED_AT, 6)->nullable();
            $table->unsignedSmallInteger(Payment::STATUS)->default(PaymentStatus::REGISTERED);
//            $table->string('password')->nullable(); @TODO: Add on meta table
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
        Schema::dropIfExists(Payment::TABLE);
    }
};
