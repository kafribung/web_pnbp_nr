<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHisotryPermohonanPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hisotry_permohonan_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cost');
            $table->smallInteger('month');
            $table->smallInteger('year');
            $table->foreignId('kua_id')->constrained('kuas')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->cascadeOnDelete();
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
        Schema::dropIfExists('hisotry_permohonan_pembayarans');
    }
}
