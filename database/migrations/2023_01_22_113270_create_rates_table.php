<?php

use App\Models\Network;
use App\Models\Rate;
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
        Schema::create('rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('network_id')->constrained('networks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('base', 3)->default('AZP');
            $table->smallInteger('currency')->default(0);
            $table->float('sell', 36, 18);
            $table->float('buy', 36, 18);
            $table->string('description')->nullable();
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
        Schema::dropIfExists(Rate::TABLE);
    }
};
