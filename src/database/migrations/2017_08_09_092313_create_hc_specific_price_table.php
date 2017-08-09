<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcSpecificPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_specific_price', function (Blueprint $table) {
            $table->integer('count', true);
            $table->enum('active', ['1', '0'])->nullable()->default('1');
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('goods_id', 36);
            $table->string('combination_id', 36)->nullable();
            $table->enum('reduction_type', ['amount', 'percentage']);
            $table->decimal('reduction', 20, 6);
            $table->timestamp('date_from')->nullable();
            $table->timestamp('date_to')->nullable();

            $table->foreign('goods_id')->references('id')->on('hc_goods')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('combination_id')->references('id')->on('hc_goods_combinations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_specific_price');
    }
}
