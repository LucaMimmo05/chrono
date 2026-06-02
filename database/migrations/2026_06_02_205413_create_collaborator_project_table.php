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
        Schema::create('collaborator_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collaborator_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->enum('rate_type', ['hourly', 'fixed']);
            $table->decimal('rate', 10, 2);
            $table->timestamps();

            $table->unique(['collaborator_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborator_project');
    }
};
