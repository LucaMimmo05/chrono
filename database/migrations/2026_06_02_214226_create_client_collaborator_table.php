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
        Schema::create('client_collaborator', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collaborator_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('client_email');
            $table->enum('default_rate_type', ['hourly', 'fixed'])->nullable();
            $table->decimal('default_rate', 10, 2)->nullable();
            $table->timestamps();

            $table->unique(['collaborator_id', 'client_email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_collaborator');
    }
};
