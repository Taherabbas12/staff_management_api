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
        Schema::create('_penalties', function (Blueprint $table) {
            $table->id('PenaltyID');
            $table->string('PenaltyType', 255);
            $table->text('Description')->nullable();
            $table->decimal('PenaltyAmount', 10, 2);
            $table->date('DateIssued');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_penalties');
    }
};