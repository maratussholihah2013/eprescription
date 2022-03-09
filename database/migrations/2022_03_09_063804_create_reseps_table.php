<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {            
            $table->id();
            $table->string('resep_kode',100)->nullable();
            $table->string('patient',100)->nullable();
            $table->string('doctor',100)->nullable();
            $table->string('poli',100)->nullable();
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
        Schema::dropIfExists('reseps');
    }
}
