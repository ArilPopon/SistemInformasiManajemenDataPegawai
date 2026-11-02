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

            $table->string('nip', 30)->unique();
            $table->string('name', 150);
            $table->string('gender', 1);

            $table->string('place_of_birth', 100);
            $table->date('date_of_birth');

            $table->text('address');

            $table->string('last_education', 100);
            $table->string('position', 100);

            $table->date('hire_date');

            $table->string('phone', 20);
            $table->string('email')->nullable()->unique();

            $table->timestamps();

            $table->index('gender');
            $table->index('last_education');
            $table->index('date_of_birth');
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
