<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vend_mqtts', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable();
            $table->string('host')->nullable();
            $table->string('imei');
            $table->string('password')->nullable();
            $table->string('port')->nullable();
            $table->string('publish_topic')->nullable();
            $table->string('subscribe_topic_prefix')->nullable();
            $table->string('username')->nullable();
            $table->string('vend_code')->nullable();
            $table->string('version')->nullable();
            $table->string('private_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vend_mqtts');
    }
};
