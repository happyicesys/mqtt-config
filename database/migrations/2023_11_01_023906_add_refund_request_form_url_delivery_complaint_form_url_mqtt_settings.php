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
            $table->string('refund_request_form_url')->nullable();
            $table->string('delivery_complaint_form_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mqtt_settings', function (Blueprint $table) {
            $table->dropColumn('refund_request_form_url');
            $table->dropColumn('delivery_complaint_form_url');
        });
    }
};
