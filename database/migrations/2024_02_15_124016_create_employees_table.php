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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('designation_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood')->nullable();
            $table->string('nid')->nullable();
            $table->string('image')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('salary')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
