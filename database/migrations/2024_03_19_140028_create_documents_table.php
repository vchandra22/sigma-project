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
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->index();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('position_id');
            $table->string('no_identitas')->unique();
            $table->string('jurusan')->nullable();
            $table->string('instansi_asal')->nullable();
            $table->string('nama_pembimbing')->nullable();
            $table->string('no_hp_pembimbing')->nullable();
            $table->date('u_tgl_mulai')->nullable();
            $table->date('u_tgl_selesai')->nullable();
            $table->date('e_tgl_mulai')->nullable();
            $table->date('e_tgl_selesai')->nullable();
            $table->string('doc_pengantar')->nullable();
            $table->string('doc_kesbang')->nullable();
            $table->string('doc_proposal')->nullable();
            $table->string('doc_laporan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
