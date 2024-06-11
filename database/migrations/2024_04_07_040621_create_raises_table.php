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
        Schema::create('raises', function (Blueprint $table) {
            $table->id('RaiseID');
            $table->unsignedBigInteger('EmployeeID');
            $table->decimal('Amount', 10, 2);
            $table->date('DateIssued');
            $table->timestamps();
            $table->foreign('EmployeeID')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raises');
    }
};
