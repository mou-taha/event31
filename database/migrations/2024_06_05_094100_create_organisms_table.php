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
        Schema::create('organisms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name', 50)->nullable();
            $table->string('slug', 55)->unique();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('map')->nullable();
            $table->text('content')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisms');
    }
};
