<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("full_name", 150)->nullable(false);
            $table->string("email", 100)->nullable(false);
            $table->string("phone_number", 20)->nullable(false);
            $table->string("national_code", 15)->nullable(false);
            $table->string("birth_date", 15)->nullable(false);
            $table->string("state", 100)->nullable(false);
            $table->string("city", 100)->nullable(false);
            $table->string("gender", 100)->nullable(false);
            $table->string("password", 100)->nullable(false);
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
        Schema::dropIfExists('students');
    }
};
