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
        Schema::table('mqtt_settings', function (Blueprint $table) {
            $table->string('payment_gateway_menu_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mqtt_settings', function (Blueprint $table) {
            $table->dropColumn('payment_gateway_menu_url');
        });
    }
};
