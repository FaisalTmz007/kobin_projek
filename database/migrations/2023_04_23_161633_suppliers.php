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
        Schema::create('supplier', function (Blueprint $table) {
            $table->id('id_supplier');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('telp');
            $table->string('alamat');
            $table->boolean('premium')->default(false);
            $table->timestamps();

            $table->unsignedBigInteger('role');
 
            $table->foreign('role')->references('id_role')->on('roles');
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
