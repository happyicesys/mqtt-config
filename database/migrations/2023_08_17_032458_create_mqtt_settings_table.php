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
        Schema::create('mqtt_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('host')->nullable();
            $table->string('password')->nullable();
            $table->string('port')->nullable();
            $table->string('publish_topic')->nullable();
            $table->string('subscribe_topic_prefix')->nullable();
            $table->string('username')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mqtt_settings');
    }
};
