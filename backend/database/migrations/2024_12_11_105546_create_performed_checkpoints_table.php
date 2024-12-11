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
        Schema::create('performed_checkpoints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignIdFor('checkpoint_id')
            ->constrained('checkpoints')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignIdFor('task_id')
            ->constrained('tasks')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performed_checkpoints');
    }
};
