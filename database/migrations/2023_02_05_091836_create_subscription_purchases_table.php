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
        Schema::create('subscription_purchases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreignUuid('subscription_id')->constrained('subscriptions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('subscription_plan_id')->constrained('subscription_plans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('payment_id')->nullable()->constrained('payments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('is_trial')->default(false);
            $table->boolean('has_auto_renew')->default(false);
            $table->boolean('is_renewed')->default(false);
            $table->boolean('is_refundable')->default(false);
            $table->timestamp('cancel_at', 6)->nullable();
            $table->timestamp('expired_at', 6)->nullable();
            $table->timestamp('purchased_at', 6)->nullable();
            $table->timestamp('started_at', 6)->nullable();
            $table->smallInteger('status')->default(0);
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
        Schema::dropIfExists('subscription_purchases');
    }
};
