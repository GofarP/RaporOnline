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
        Schema::create('wali_kelas',function(Blueprint $table){
            $table->string('id_wali_kelas')->primary();
            $table->string('nip');
            $table->string('id_kelas');
            $table->string('id_tahun_ajaran');


            $table->foreign('nip')->references('nip')
            ->on('guru');

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
        Schema::dropIfExists('wali_kelas');
    }
};
