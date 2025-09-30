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
        Schema::create('virtuals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('link')->nullable();
            $table->string('content')->nullable();
            $table->datetime('datestart')->nullable();
            $table->datetime('dateend')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('virtuals');
    }
};
