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
        Schema::create('purse_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreignUuid('purse_id')->constrained('purses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('percentage', 5, 2)->default(100.00);
            $table->text('signature')->nullable();//Digital Signature for grant access
            $table->string('daily_limit')->nullable();
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
        Schema::dropIfExists('purse_users');
    }
};
