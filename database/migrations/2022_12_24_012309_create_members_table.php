<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->enum('document_type', ['Registro civil', 'Tarjeta de identidad', 'Cédula de ciudanía', 'Tarjeta de extranjería', 'Pasaporte']);
            $table->string('document_number');
            $table->timestamp('date_of_birth');
            $table->enum('sex', ['Femenino', 'Masculino']);
            $table->enum('civil_state', ['Soltero', 'Casado', 'Conviviente civil', 'Divorciado', 'Viudo']);
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->enum('is_baptized', ['Si', 'No'])->default('No');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('neighborhood_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('cell_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
