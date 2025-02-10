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
        Schema::create('video_link', function (Blueprint $table) {
            $table->id();
            $table->string('lyric_id')->nullable();
            $table->text('link')->nullable();
            $table->string('uploader_id')->nullable();
            $table->string('uploader_type')->nullable();
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
