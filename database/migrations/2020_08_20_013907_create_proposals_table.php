<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->integer('users_id');
            $table->integer('categories_id');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('max_requirement')->nullable();
            $table->string('satuan');
            $table->Biginteger('price');
            $table->Biginteger('total_price');
            $table->longText('benefit')->nullable();
            $table->longText('description')->nullable();
            $table->string('proposal_status');
            $table->longText('note')->nullable();
            $table->longText('link')->nullable();
            $table->string('slug');
            
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
        Schema::dropIfExists('proposals');
    }
}
