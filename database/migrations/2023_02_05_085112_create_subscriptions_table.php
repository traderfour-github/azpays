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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuidMorphs('subscribable');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('introduction')->nullable();
            $table->decimal('charity', 5, 2)->default(0);
            $table->decimal('amount', 36, 18)->default(0);
            $table->smallInteger('currency')->default(0);
            $table->smallInteger('period')->default(0);
            $table->decimal('entry_fee', 36, 18)->default(0);
            $table->smallInteger('max_capacity')->default(0);
            $table->integer('max_trials')->default(0);
            $table->boolean('refundable')->default(false);
            $table->boolean('invite_only')->default(false);
            $table->boolean('private')->default(false);
            $table->text('webhook')->nullable();
            $table->smallInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
//            TODO: create family subscription in future => User can add up to 5 members as family
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
