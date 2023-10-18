<?php

use App\Enums\Merchant\Status;
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
        Schema::create('merchants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->unsignedSmallInteger('status')->default(Status::ACTIVE);
            $table->string('tell');
            $table->string('domain');
            $table->ipAddress('ip')->nullable();
            $table->string('webhook')->nullable();
            $table->string('callback')->nullable();
            $table->text('description')->nullable();
            $table->string('support_email')->nullable();
            $table->string('support_phone')->nullable();
            $table->string('support_url')->nullable();
            $table->string('color', 6)->nullable();
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
        Schema::dropIfExists('merchants');
    }
};
