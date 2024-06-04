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
        Schema::create('incentives', function (Blueprint $table) {
            $table->id('IncentiveID');
            $table->string('IncentiveType', 255);
            $table->text('Description')->nullable();
            $table->decimal('Amount', 10, 2);
            $table->date('DateIssued');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incentives');
    }
};
