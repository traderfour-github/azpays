<?php

use App\Models\Gateway;
use App\Models\Network;
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
        Schema::create(Network::TABLE, function (Blueprint $table) {
            $table->uuid(Network::ID)->primary();
            $table->foreignUuid(Network::GATEWAY_ID)->constrained(Gateway::TABLE)->cascadeOnUpdate()->cascadeOnDelete();
            $table->string(Network::NAME);
            $table->string(Network::LOGO)->nullable();
            $table->decimal(Network::FEE, 3, 2)->default(2.00);
            $table->string(Network::SUPPORT_PORTAL)->nullable();
            $table->string(Network::SUPPORT_EMAIL)->nullable();
            $table->string(Network::SUPPORT_PHONE)->nullable();
            $table->unsignedBigInteger(Network::PROCESSING_TIME)->nullable();
            $table->unsignedBigInteger(Network::CONFIRM_TIME)->nullable();
            $table->unsignedBigInteger(Network::PAYOUT_TIME)->nullable();
            $table->text(Network::COUNTRIES)->nullable();
            $table->text(Network::PROCESSORS)->nullable();
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
        Schema::dropIfExists(Network::TABLE);
    }
};
