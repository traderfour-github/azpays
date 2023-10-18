<?php

use App\Enums\Purse\Status;
use App\Enums\Purse\Type;
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
        Schema::create('purses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->smallInteger('currency')->default(0);
            $table->string('note')->nullable();
            $table->unsignedSmallInteger('type')->default(Type::GENERAL);
            $table->unsignedSmallInteger('status')->default(Status::ACTIVE);
            $table->string('address')->unique();
            $table->string('public_key')->nullable();
            $table->string('private_key')->nullable();
            $table->string('signature')->nullable();
            $table->string('color', 6)->nullable();
            $table->string('balance')->default(0);
            $table->string('freeze')->default(0);
            $table->string('locked')->default(0);
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
        Schema::dropIfExists('purses');
    }
};
