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
            $table->string('id_data')->primary();
            $table->string('NIP');
            $table->string('NISN');
            $table->string('id_mapel');
            $table->string('id_kelas');
            $table->string('id_tahun_ajar');
            $table->string('nilai');
            $table->timestamps();

            $table->foreign('NIP')->references('NIP')
            ->on('guru')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('NISN')->references('NISN')
            ->on('siswa')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_mapel')->references('id_mapel')
            ->on('mata_pelajaran')
            ->onDelete('cascade')
            ->onDelete('cascade');

            $table->foreign('id_kelas')->references('id_kelas')
            ->on('kelas')
            ->onDelete('cascade')
            ->onDelete('cascade');

            $table->foreign('id_tahun_ajar')->references('id_tahun_ajar')
            ->on('tahun_ajar')
            ->onDelete('cascade')
            ->onDelete('cascade');

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
