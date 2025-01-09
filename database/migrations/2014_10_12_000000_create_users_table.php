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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // dodanie kolumny z nazwą
            $table->string('email')->unique(); //dodanie kolumny z unikalnym mailem
            $table->string("role")->default("customer"); //dodanie kolumn roli ktora domyslnie jest zawsze klientem
            $table->timestamp('email_verified_at')->nullable(); //moment weryfikacji adresu mailowego
            $table->string('password'); //haslo 
            $table->string('address')->default(''); // Dodanie kolumny adres
            $table->rememberToken(); // token zapamietaj mnie
            $table->timestamps(); //dwie kolumy created i updated
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); 
    }
};