<?php

use App\Enums\Gateway\GatewayStatus;
use App\Models\Gateway;
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
        Schema::create(Gateway::TABLE, function (Blueprint $table) {
            $table->uuid(Gateway::ID)->primary();
            $table->uuid('user_id');
            $table->string(Gateway::NAME);
            $table->string(Gateway::LOGO)->nullable();
            $table->unsignedSmallInteger(Gateway::STATUS)->default(GatewayStatus::REGISTERED->value);
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
        Schema::dropIfExists(Gateway::TABLE);
    }
};
