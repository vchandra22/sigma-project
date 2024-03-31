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
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->text('deskripsi_app')->nullable();
            $table->string('instagram_username')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtube_channel')->nullable();
            $table->string('youtube_link')->nullable();
            $table->text('id_video')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telp')->nullable();
            $table->text('gmaps_kantor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepages');
    }
};
