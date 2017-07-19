<?php

namespace interactivesolutions\honeycombecommercepricerules\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECPriceRules extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_prices_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'from', 'to', 'type', 'amount'];
}