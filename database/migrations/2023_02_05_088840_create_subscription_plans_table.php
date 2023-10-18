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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid("subscription_id")->constrained("subscriptions")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->boolean('verified')->default(false);
            $table->decimal('charity_share', 3,2)->unsigned();
            $table->decimal('share', 3,2)->unsigned();
            $table->integer('price')->unsigned();
            $table->integer('duration')->default(30)->unsigned();
            $table->integer('entry_fee')->unsigned();
            $table->bigInteger('capacity')->unsigned()->nullable();
            $table->integer('trials')->nullable();
            $table->boolean('affiliate')->default(false);
            $table->bigInteger('maximum_accounts')->unsigned()->nullable();
            $table->boolean('invite_only')->default(false);
            $table->boolean('private')->default(false);
            $table->integer('max_profit')->nullable();
            $table->integer('max_warranty')->nullable();
            $table->integer('warranty_share')->nullable();
            $table->integer('cost_share')->nullable();
            $table->longText('features')->nullable();
            $table->unsignedSmallInteger("status")->default(11000);
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
        Schema::dropIfExists('subscription_plans');
    }
};
