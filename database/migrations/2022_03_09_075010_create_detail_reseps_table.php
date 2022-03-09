<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailResepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_reseps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resep_id');
            $table->unsignedBigInteger('signa_id');
            $table->tinyInteger('jenis_racikan')->default(0)->comment('1 : Racikan, 0:Non Racikan');
            $table->string('nama_racikan',100)->nullable();
            $table->timestamps();


            $table->foreign('resep_id')->references('id')->on('reseps')->onDelete('cascade');
            $table->foreign('signa_id')->references('id')->on('signas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_reseps');
    }
}
