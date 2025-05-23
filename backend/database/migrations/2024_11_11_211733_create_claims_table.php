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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()
            ->constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->text('description');
            $table->foreignId('category_id')->nullable()
            ->constrained('categories')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->string('file_url')->nullable();
            $table->foreignId('claim_status_id')
            ->nullable()
            ->constrained('claim_statuses')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
