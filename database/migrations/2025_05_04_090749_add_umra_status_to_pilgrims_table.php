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
        Schema::table('pilgrims', function (Blueprint $table) {
            $table->string('umra_status')->default('waiting');
            $table->date('last_umra_date')->nullable();
        });

        Schema::table('pilgrims', function (Blueprint $table) {
            $table->renameColumn('status', 'hajj_status');
            $table->renameColumn('last_pilgrimage_date', 'last_hajj_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pilgrims', function (Blueprint $table) {
            $table->renameColumn('hajj_status', 'status');
            $table->renameColumn('last_hajj_date', 'last_pilgrimage_date');
            $table->dropColumn('umra_status', 'last_umra_date');
        });
    }
};
