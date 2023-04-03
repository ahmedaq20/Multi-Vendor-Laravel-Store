<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            // id BIG-INT UNSIGNED AUTO INCREMENT PRIMARY
            $table->id();
            $table->string('name');//varchar(255)
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('stores');
    }
}
