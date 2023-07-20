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
        Schema::create('nilai_master', function (Blueprint $table) {
            $table->string('id_nilai_master')->primary();
            $table->string('NIP');
            $table->string('NISN');
            $table->string('id_mapel');
            $table->string('id_kelas');
            $table->string('id_tahun_ajaran');
            $table->string('semester');
            $table->string('nilai');
            $table->timestamps();

            $table->foreign('NIP')->references('NIP')
            ->on('guru');

            $table->foreign('NISN')->references('NISN')
            ->on('siswa');

            $table->foreign('id_mapel')->references('id_mapel')
            ->on('mata_pelajaran');

            $table->foreign('id_kelas')->references('id_kelas')
            ->on('kelas');

            $table->foreign('id_tahun_ajaran')->references('id_tahun_ajaran')
            ->on('tahun_ajaran');


        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_master');
    }
};
