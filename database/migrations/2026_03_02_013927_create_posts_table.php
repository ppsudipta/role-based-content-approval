<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->id();

            // Author
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Content
            $table->string('title');
            $table->text('body');

            // Status (use string for Enum casting)
            $table->string('status')->default('pending');

            // Approval
            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->text('rejected_reason')->nullable();

            $table->timestamps();

            // Soft delete (IMPORTANT for audit)
            $table->softDeletes();

            // Indexes (performance)
            $table->index(['user_id', 'status']);
            $table->index('approved_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};