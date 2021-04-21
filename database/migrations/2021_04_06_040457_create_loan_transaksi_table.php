<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id');
            $table->foreignId('kendaraan_id');
            $table->foreignId('type_id');
            $table->foreignId('nama_id');
            $table->foreignId('detail_id');
            $table->bigInteger('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_transaksi');
    }
}
