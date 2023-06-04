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
        Schema::create('resetPassword', function (Blueprint $table) {
            $table->id('id');
            $table->string('passwordBaru');
            $table->timestamps();

            $table->unsignedBigInteger('fk_owner');
            $table->foreign('fk_owner')->references('id_owner')->on('owner');
            $table->unsignedBigInteger('fk_supplier');
            $table->foreign('fk_supplier')->references('id_supplier')->on('supplier');
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
