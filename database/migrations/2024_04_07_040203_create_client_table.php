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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('landline')->nullable();
            $table->string('pager_number')->nullable();
            $table->binary('profile_image')->nullable();
            $table->binary('id_front_image')->nullable();
            $table->binary('id_back_image')->nullable();
            $table->decimal('salary', 8, 2)->nullable(); // الراتب
            $table->decimal('basic_salary', 8, 2)->nullable(); // الراتب الاسمي
            $table->integer('number_of_wives')->nullable(); // عدد الزوجات
            $table->integer('number_of_children')->nullable(); // عدد الاطفال
            $table->string('employment_type')->nullable(); // نوع التعيين
            $table->decimal('salary_increase', 8, 2)->nullable(); // زيادة الراتب
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
