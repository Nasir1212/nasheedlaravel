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
        Schema::table('nasheed_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nasheed_id');
            $table->string('ip_address');
            $table->string('user_agent')->nullable(); // Browser or device info
            $table->timestamps();
            $table->unique(['nasheed_id', 'ip_address', 'user_agent']); // Ensure unique views
            $table->foreign('nasheed_id')->references('id')->on('nate_rasul')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('nasheed_views', function (Blueprint $table) {
        //     //
        // });
    }
};
