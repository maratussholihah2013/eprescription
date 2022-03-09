<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signas', function (Blueprint $table) {
            $table->id();
            $table->string('signa_kode',100)->nullable();
            $table->string('signa_nama',250)->nullable();
            $table->text('additional_data')->nullable();
            $table->timestamp('created_date')->useCurrent();
            $table->integer('created_by')->length(11)->unsigned()->nullable();
            $table->integer('modified_count')->length(11)->unsigned()->nullable();
            $table->timestamp('last_modified_date')->nullable();
            $table->integer('last_modified_by')->length(11)->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('deleted_date')->nullable();
            $table->integer('deleted_by')->length(11)->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signas');
    }
}
