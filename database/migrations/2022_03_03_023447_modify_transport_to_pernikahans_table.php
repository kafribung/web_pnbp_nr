<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTransportToPernikahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pernikahans', function (Blueprint $table) {
            $table->integer('transport')->nullable()->after('kua_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pernikahans', function (Blueprint $table) {
            $table->integer('transport')->after('kua_id');
        });
    }
}
