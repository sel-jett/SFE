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
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedMediumInteger('customerId');
            $table->tinyText('username');
            $table->tinyText('nom');
            $table->tinyText('prenom');
            $table->tinyText('email');
            $table->tinyText('password');
            $table->unsignedSmallInteger('currentPayingMethodId');
            $table->boolean('accountActivated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('clients', [
            'customerId', 'username', 'nom', 'prenom', 'email', 'password', 'currentPayingMethodId', 'accountActivated'
        ]);
    }
};
