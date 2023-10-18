<?php

use App\Enums\Transaction\TransactionStatus;
use App\Enums\Transaction\TransactionType;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('authority')->unique();
            $table->unsignedSmallInteger('type')->default(TransactionType::DEPOSIT);
            $table->uuid('payee_id');
            $table->float('payee_pre_balance', 36, 18);
            $table->float('payee_post_balance', 36, 18);
            $table->uuid('payer_id')->nullable();
            $table->float('payer_pre_balance', 36, 18);
            $table->float('payer_post_balance', 36, 18);
            $table->string('amount')->nullable();
            $table->string('payee_description')->nullable();
            $table->string('payer_description')->nullable();
            $table->string('trace_number')->nullable();
            $table->smallInteger('currency')->default(0);
            $table->timestamp('detected_at', 6)->nullable();
            $table->timestamp('verified_at', 6)->nullable();
            $table->unsignedSmallInteger('status')->default(TransactionStatus::DEFAULT);
            $table->nullableMorphs('transactional');
            $table->foreignUuid('gateway_id')->constrained('gateways')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('network_id')->constrained('networks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('rate_id')->constrained('rates')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('transactions');
    }
};
