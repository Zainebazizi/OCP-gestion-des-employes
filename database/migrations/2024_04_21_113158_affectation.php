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

    Schema::disableForeignKeyConstraints();
    Schema::create('affectations', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('code_matricule');
        $table->foreignId('telephone_N');
        $table->string('application1')->nullable(); // Ajoutez cette ligne pour le premier champ d'application
        $table->string('application2')->nullable(); // Ajoutez cette ligne pour le deuxième champ d'application
        $table->string('application3')->nullable(); // Ajoutez cette ligne pour le troisième champ d'application
        $table->string('application4')->nullable(); // Ajoutez cette ligne pour le quatrième champ d'application
        $table->date('date_debut');
        $table->date('date_fin')->nullable()->default(DB::raw('DATE_ADD(date_debut, INTERVAL 2 YEAR)'));
        $table->timestamps();
    });
    Schema::enableForeignKeyConstraints();
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
