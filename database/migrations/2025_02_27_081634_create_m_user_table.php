<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('level_id')->index(); //untuk foreignKey
            $table->string('username', 20)->unique(); //memastikan username tidak ada yang sama
            $table->string('nama', 100);
            $table->string('password');
            $table->timestamps();

            //mendefinisikan ForeignKey pada kolom Level_id yg mengacu pd level_id di tabel m_level 
            $table->foreign('level_id')->references('level_id')->on('m_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
