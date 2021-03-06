<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->dateTime('dateDebut');
            $table->dateTime('dateFin');
            $table->string('etat');
            $table->foreignId('structure_id')->constrained();  
            $table->foreignId('fournisseur_id')->constrained();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints(); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {Schema::table("factures",function(Blueprint $table){
         $table->dropConstrainedForeignId("structure_id"); 
         $table->dropConstrainedForeignId("fournisseur_id"); 
    });
        Schema::dropIfExists('factures');
    }
}
