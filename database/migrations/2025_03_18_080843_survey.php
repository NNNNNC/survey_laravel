<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('client_type');
            $table->date('date');
            $table->unsignedInteger('age');
            $table->enum('sex', ['Male', 'Female']);
            $table->foreignId('office_visited')->constrained('offices')->onDelete('cascade');
            $table->foreignId('service')->constrained('services')->onDelete('cascade');
            $table->integer('awareness')->default(0);
            $table->integer('visibility')->default(0);
            $table->integer('helpfulness')->default(0);
            $table->integer('SQD0')->default(0);
            $table->integer('SQD1')->default(0);
            $table->integer('SQD2')->default(0);
            $table->integer('SQD3')->default(0);
            $table->integer('SQD4')->default(0);
            $table->integer('SQD5')->default(0);
            $table->integer('SQD6')->default(0);
            $table->integer('SQD7')->default(0);
            $table->integer('SQD8')->default(0);
            $table->text('comments')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('surveys');
    }
};
