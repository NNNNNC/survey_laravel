<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('client_type');
            $table->date('date');
            $table->integer('age');
            $table->string('sex');
            $table->string('office_visited');
            $table->string('service');
            $table->timestamps();
        });
    }
    
};
