<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRacikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_racikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_resep_id');
            $table->unsignedBigInteger('obatalkes_id');            
            $table->decimal('kuantitas',15,2)->nullable();
            $table->timestamps();


            $table->foreign('detail_resep_id')->references('id')->on('detail_reseps')->onDelete('cascade');
            $table->foreign('obatalkes_id')->references('id')->on('obatalkes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_racikans');
    }
}
