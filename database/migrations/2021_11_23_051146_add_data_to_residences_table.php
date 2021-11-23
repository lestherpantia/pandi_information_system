<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToResidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residences', function (Blueprint $table) {
            $table->boolean('senior')->nullable();
            $table->boolean('disability')->nullable();
            $table->boolean('solo_parent')->nullable();
            $table->boolean('pregnant')->nullable();
            $table->boolean('lactating_mother')->nullable();
            $table->boolean('homeless')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residences', function (Blueprint $table) {
            //
        });
    }
}
