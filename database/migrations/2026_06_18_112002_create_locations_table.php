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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('order');
            $table->string('direction')->nullable();
            $table->string('position')->nullable();
            $table->string('segment')->nullable();
            $table->string('section')->nullable();
            $table->integer('hm1')->nullable();
            $table->integer('hm2')->nullable();
            $table->integer('km1')->nullable();
            $table->integer('km2')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
