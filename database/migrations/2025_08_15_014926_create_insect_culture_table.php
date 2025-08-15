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
        Schema::create('insect_culture', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insect_id');
            $table->unsignedBigInteger('culture_id');

            $table->foreign('insect_id')->references('id')->on('insects')->onDelete('cascade');
            $table->foreign('culture_id')->references('id')->on('cultures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insect_culture');
    }
};
