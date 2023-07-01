<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atur_mata_pelajaran',function(Blueprint $table){
            $table->string('id_atur_mata_pelajaran')->primary();
            $table->string('id_mata_pelajaran');
            $table->string('id_kelas');
            $table->string('id_tahun_ajaran');
            $table->timestamps();

            $table->foreign('id_mata_pelajaran')->references('id_mata_pelajaran')
            ->on('mata_pelajaran');

            $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')
            ->on('tahun_ajaran');

            $table->foreign('id_kelas')->references('id_kelas')
            ->on('kelas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atur_mata_pelajaran');
    }
};
