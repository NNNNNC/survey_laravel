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
            $table->integer('age')->unsigned();
            $table->enum('sex', ['Male', 'Female', 'Other']);
            $table->string('office_visited');
            $table->string('service');
            $table->integer('awareness');
            $table->integer('visiblity');
            $table->integer('helpfulness');
            $table->integer('service_satisfaction');
            $table->integer('transaction_time');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('surveys');
    }
};

