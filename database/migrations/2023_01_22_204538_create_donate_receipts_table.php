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
        Schema::create('donate_receipts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('donation_id')->constrained('donations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('payer_id');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('donate_receipts');
    }
};
