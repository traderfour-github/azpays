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
        Schema::create('discount_usages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid("user_id");
            $table->foreignUuid("discount_id")->constrained("discounts")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('payment_id')->constrained('payments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuidMorphs('model');
            $table->unsignedSmallInteger("status")->default(12000);
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
        Schema::dropIfExists('discount_usages');
    }
};
