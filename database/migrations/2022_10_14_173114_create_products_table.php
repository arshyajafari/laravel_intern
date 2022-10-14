<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('products', function (Blueprint $table) {
                $table->increments("id")->nullable(false);
                $table->string("title", 100)->nullable(false);
                $table->string("description", 500)->nullable(true);
                $table->integer("price")->nullable(false)->default("0");
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('products');
        }
    };
