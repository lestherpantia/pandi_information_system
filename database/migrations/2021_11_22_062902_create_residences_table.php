<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_hold_id')->nullable()->constrained('house_holds')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('barangay_id')->nullable()->constrained('barangays')->onUpdate('cascade')->onDelete('restrict');
            $table->string('last_name', 45)->nullable();
            $table->string('first_name', 45)->nullable();
            $table->string('middle_name', 45)->nullable();
            $table->string('birthday', 45)->nullable();
            $table->string('place_of_birth_town', 45)->nullable();
            $table->string('place_of_birth_province', 45)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('gender_other', 45)->nullable();
            $table->string('marital_status', 45)->nullable();
            $table->string('marital_status_other', 45)->nullable();
            $table->string('address_house_no', 100)->nullable();
            $table->string('address_street', 100)->nullable();
            $table->string('address_sitio', 100)->nullable();
            $table->string('mobile_number', 12)->nullable();
            $table->string('sectoral_group', 45)->nullable();
            $table->string('nationality', 45)->nullable();
            $table->string('nationality_other', 45)->nullable();
            $table->string('employed', 15)->nullable();
            $table->string('employed_other', 45)->nullable();
            $table->string('engaged_in_business', 45)->nullable();
            $table->string('business_name', 45)->nullable();
            $table->string('business_type', 45)->nullable();
            $table->string('registered_voter', 20)->nullable();
            $table->string('registered_voter_other', 50)->nullable();
            $table->string('religious_affiliation', 45)->nullable();
            $table->string('religious_affiliation_other', 45)->nullable();
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
        Schema::dropIfExists('residences');
    }
}
