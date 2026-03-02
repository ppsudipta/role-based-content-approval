<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('post_logs', function (Blueprint $table) {
            $table->string('action')->change(); // 🔥 change enum to string
        });
    }

    public function down(): void
    {
        Schema::table('post_logs', function (Blueprint $table) {
            $table->enum('action', ['created','approved','rejected','deleted'])->change();
        });
    }
};