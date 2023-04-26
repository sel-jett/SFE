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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username')->unique();
            $table->integer('customerId')->nullable();
            $table->unsignedBigInteger('currentPayingMethodId')->nullable();
            $table->boolean('accountActivated')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('clients',[
            'nom','prenom','email','password','username', 'customerId', 'currentPayingMethodId', 'accountActivated'
        ]);
    }
};
