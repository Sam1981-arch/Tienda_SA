<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('garment_has_users', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('garment_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->date('date_loan');
			$table->date('date_return');
            $table->timestamps();
			$table->softDeletes();

			$table->foreign('garment_id')
			->references('id')
			->on('garments')
			->onDelete('cascade');

			$table->foreign('user_id')
			->references('id')
			->on('users')
			->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('garments_has_users');
    }
};
