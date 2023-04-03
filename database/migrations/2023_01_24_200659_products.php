<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('store_id')->constrained('stores')->cascadOnDelete();
                    $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
                    $table->string('name');
                    $table->string('slug')->unique();
                    $table->string('image')->nullable();
                    $table->text('description')->nullable();
                    $table->float('price')->default(0);
                    $table->float('compare_price')->nullable();
                    $table->json('option')->nullable();
                    $table->float('rating')->default(0);
                    $table->boolean('featured')->default(0);
                    $table->enum('status', ['active', 'draft','archived'])->nullable()->default('active');
                    $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
