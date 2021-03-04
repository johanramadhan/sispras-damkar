<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name');
            $table->integer('users_id');
            $table->integer('categories_id');
            $table->string('kondisi');
            $table->string('status');
            $table->Biginteger('qty');
            $table->Biginteger('price');
            $table->Biginteger('total_price');
            $table->string('satuan');
            $table->string('brand');
            $table->longText('link')->nullable();
            $table->longText('fungsi')->nullable();
            $table->longText('description');
            
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
