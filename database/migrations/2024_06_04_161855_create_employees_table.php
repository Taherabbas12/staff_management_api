<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employeesID');
            $table->decimal('salary', 10, 2);
            $table->decimal('nominal_salary', 10, 2);
            $table->integer('number_of_children');
            $table->string('appointment_type', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_employee');
    }
};
