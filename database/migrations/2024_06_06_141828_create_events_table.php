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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('organism_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('menu_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('type_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('subtype_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title', 50)->nullable();
            $table->string('slug', 55)->nullable()->unique();
            $table->string('subtitle')->nullable();
            $table->string('link')->nullable();
            $table->string('content')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
