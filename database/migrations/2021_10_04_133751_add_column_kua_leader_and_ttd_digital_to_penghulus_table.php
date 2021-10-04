<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKuaLeaderAndTtdDigitalToPenghulusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penghulus', function (Blueprint $table) {
            $table->boolean('kua_leader')->default(0);
            $table->string('ttd_digital')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penghulus', function (Blueprint $table) {
            $table->dropColumn('kua_leader');
            $table->dropColumn('ttd_digital');
        });
    }
}
