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
        Schema::table('mata_pelajaran_guru',function(Blueprint $table) {
            $table->string('id_mapel_guru')->primary();
            $table->string('nip');
            $table->string('id_mapel');
            $table->timestamps();

            $table->foreign('nip')->references('nip')
            ->on('guru');

            $table->foreign('id_mapel')->references('nip')
            ->on('mata_pelajaran');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
