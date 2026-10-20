<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('penarikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Kolom user_id yang menjadi foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Menambahkan foreign key ke nasabahs
            $table->date('tanggal');
            $table->decimal('jumlah', 15,0); // Kolom jumlah dengan 2 desimal
            $table->string('status')->default('Pending'); // Status default 'Pending'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penarikans');
    }
};
