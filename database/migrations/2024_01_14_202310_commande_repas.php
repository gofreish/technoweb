<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Repas;
use App\Models\Commande;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commande_repas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Commande::class);
            $table->foreignIdFor(Repas::class);
            $table->integer("nombre");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_repas');
    }
};
