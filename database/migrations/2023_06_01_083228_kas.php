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
        Schema::create('kas', function (Blueprint $table) {
            $table->id('id');
            $table->date('tanggal');
            $table->integer('jumlah_masuk');
            $table->integer('jumlah_keluar');
            $table->string('keterangan');

            $table->unsignedBigInteger('id_owner');
            $table->foreign('id_owner')->references('id_owner')->on('owner');
            $table->unsignedBigInteger('id_supplier');
            $table->foreign('id_supplier')->references('id_supplier')->on('supplier');
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
