<?php

namespace interactivesolutions\honeycombecommercepricerules\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECPriceRulesAffectedItems extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_prices_rules_affected_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'rule_id', 'rulable_type', 'rulable_id'];

    /**
     * Has many affected items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rule()
    {
        return $this->belongsTo(HCECPriceRules::class, 'rule_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function rulable()
    {
        return $this->morphTo();
    }
}