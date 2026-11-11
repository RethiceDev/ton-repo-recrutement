<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('entretiens', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 100);
        $table->string('prenoms', 150);
        $table->string('poste', 150);
        $table->string('telephone', 20); // Corrigé en string
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
