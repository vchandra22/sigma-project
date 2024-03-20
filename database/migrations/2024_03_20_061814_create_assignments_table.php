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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id')->index()->nullable();
            $table->string('judul')->nullable();
            $table->string('slug')->nullable();
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->text('pertanyaan')->nullable();
            $table->string('doc_pertanyaan')->nullable();
            $table->string('doc_jawaban')->nullable();
            $table->enum('status', ['dikirim', 'selesai', 'terlambat'])->default('dikirim')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
