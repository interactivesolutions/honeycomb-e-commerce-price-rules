<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToHcPricesRulesAffectedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_prices_rules_affected_items', function (Blueprint $table) {
            $table->unique(['rule_id', 'rulable_id', 'rulable_type'], 'unique_rule_for_items');
            $table->index('rulable_id');
            $table->index('rulable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_prices_rules_affected_items', function (Blueprint $table) {
            $table->dropUnique('unique_rule_for_items');
            $table->dropIndex(['rulable_id']);
            $table->dropIndex(['rulable_type']);
        });
    }
}
