<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('kendaraan_nama');
            $table->timestamps();
        });

        Schema::create('cat_type_ban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('cat_kendaraan')->onDelete('cascade');
            $table->string('type_nama');
            $table->timestamps();
        });

        Schema::create('cat_nama_ban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('cat_kendaraan')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('cat_type_ban')->onDelete('cascade');
            $table->string('ban_nama');
            $table->timestamps();

        });

        Schema::create('cat_detail_ban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('kendaraan_id')->constrained('cat_kendaraan')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('cat_type_ban')->onDelete('cascade');
            $table->foreignId('nama_id')->constrained('cat_nama_ban')->onDelete('cascade');
            $table->string('ukuran_ban');
            $table->bigInteger('stock');
            $table->bigInteger('harga');
            $table->string('rim')->nullable();
            $table->float('pelek')->nullable();
            $table->string('tipe')->nullable();
            $table->string('ply')->nullable();
            $table->timestamps();
        });

        Schema::create('stock_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('detail_id')->constrained('cat_detail_ban')->onDelete('cascade');
            $table->foreignId('staf_id')->nullable()->constrained('staf');
            $table->bigInteger('stock_input')->nullable();
            $table->bigInteger('stock_output')->nullable();
            $table->bigInteger('stock_update')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('cat_kendaraan');
        Schema::dropIfExists('cat_type_ban');
        Schema::dropIfExists('cat_nama_ban');
        Schema::dropIfExists('cat_detail_ban');
        Schema::dropIfExists('stock_detail');
    }
}
