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
        Schema::create('carousels', function (Blueprint $table) {
            $table->id('id');
            $table->string('ownerName');
            $table->enum('ceremonyType', ['0', '1', '2'])->default('0'); // 0: Pawiwahan, 1: Mepandes, 2: Tigabulanan
            $table->string('guestName');
            $table->text('guestMessage');
            $table->enum('guestAttendance', ['0', '1', '2'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousels');
    }
};
