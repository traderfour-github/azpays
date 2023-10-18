<?php

use App\Enums\Discount\DiscountStatusEnum;
use App\Enums\Discount\DiscountTypeEnum;
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
        Schema::create('discounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->enum('type', DiscountTypeEnum::getValues()); // percentage or fixed
            $table->string('value');
            $table->string('max_value')->nullable();
            $table->unsignedInteger('max_use')->nullable();
            $table->unsignedInteger('use_count')->nullable();
            $table->unsignedInteger('max_use_per_user')->nullable();
            $table->boolean('first_purchase')->default(false);
            $table->timestamp('start_at');
            $table->timestamp('expired_at')->nullable();
            $table->enum('status', DiscountStatusEnum::getValues());
            $table->softDeletes();
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
        Schema::dropIfExists('discounts');
    }
};
