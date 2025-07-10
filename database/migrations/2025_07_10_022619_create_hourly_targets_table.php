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
        Schema::create('hourly_targets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('line_id');
            $table->string('hour_slot'); // contoh: "08:00-09:00"
            $table->date('effective_date');
            $table->integer('default_target');
            $table->integer('actual_target')->nullable();
            $table->boolean('is_overtime')->default(false);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            // Relasi ke tabel lines
            $table->foreign('line_id')->references('id')->on('lines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hourly_targets');
    }
};
