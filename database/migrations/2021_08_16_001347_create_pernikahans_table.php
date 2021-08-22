<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePernikahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pernikahans', function (Blueprint $table) {
            $table->id();
            $table->string('male', 30);
            $table->string('female', 30);
            $table->char('male_age', 3);
            $table->char('female_age', 3);
            $table->string('village', 30);
            $table->string('marriage_certificate_number', 15);
            $table->string('perforation_number', 15);
            $table->foreignId('penghulu_id')->constrained('penghulus')->cascadeOnDelete();
            $table->foreignId('peristiwa_nikah_id')->constrained('peristiwa_nikahs')->cascadeOnDelete();
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
        Schema::dropIfExists('pernikahans');
    }
}
