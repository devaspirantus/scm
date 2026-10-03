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
        Schema::create('enrolements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentID')->references('id')->on('students')->onUpdate('cascade');
    $table->foreignId('courseID')->references('id')->on('courses')->onUpdate('cascade');
    $table->date('enrolements_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrolements');
    }
};
