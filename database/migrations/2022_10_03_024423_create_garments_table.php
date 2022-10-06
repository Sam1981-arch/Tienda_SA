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
        Schema::create('garments', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('brand_id')->unsigned();
			$table->bigInteger('category_id')->unsigned();
			$table->string('name');
			$table->integer('stock');
			$table->string('Description')->nullable();
			$table->decimal('price')->nullable()->default(0.00);
            $table->timestamps();
			$table->softDeletes();

			$table->foreign('brand_id')
			->references('id')
			->on('brands')
			->onDelete('cascade');

			$table->foreign('category_id')
			->references('id')
			->on('categories')
			->onDelete('cascade');
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('garments');
    }
};
