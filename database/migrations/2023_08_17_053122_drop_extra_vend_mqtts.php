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
        Schema::table('vend_mqtts', function (Blueprint $table) {
            $table->dropColumn('host');
            $table->dropColumn('password');
            $table->dropColumn('port');
            $table->dropColumn('publish_topic');
            $table->dropColumn('subscribe_topic_prefix');
            $table->dropColumn('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vend_mqtts', function (Blueprint $table) {
            //
        });
    }
};
