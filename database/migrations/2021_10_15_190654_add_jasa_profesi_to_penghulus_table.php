<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJasaProfesiToPenghulusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penghulus', function (Blueprint $table) {
            $table->integer('jasa_profesi')->after('kua_id');
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
            $table->dropColumn('jasa_profesi');
        });
    }
}
