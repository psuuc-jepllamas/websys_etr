<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('duplicate_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('student_name', 255);
            $table->string('or_no', 50);
            $table->enum('type', ['Undergraduate', 'Graduate']);
            $table->timestamp('attempted_at');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('duplicate_attempts');
    }
};