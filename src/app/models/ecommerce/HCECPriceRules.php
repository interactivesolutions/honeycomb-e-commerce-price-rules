<?php

namespace interactivesolutions\honeycombecommercepricerules\app\models\ecommerce;

use Carbon\Carbon;
use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECCategories;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;

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

    /**
     * Is active rule
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsActiveRule($query)
    {
        $now = Carbon::now()->toDateTimeString();

        return $query->where('from', '<=', $now)->where('to', '>', $now);
    }

    /**
     * Has many affected items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function affected_items()
    {
        return $this->hasMany(HCECPriceRulesAffectedItems::class, 'rule_id', 'id');
    }

    /**
     * Get all of the goods that are assigned this rule.
     */
    public function goods()
    {
        return $this->morphedByMany(HCECGoods::class, 'rulable', HCECPriceRulesAffectedItems::getTableName(), 'rule_id');
    }

    /**
     * Get all of the categories that are assigned this rule.
     */
    public function categories()
    {
        return $this->morphedByMany(HCECCategories::class, 'rulable', HCECPriceRulesAffectedItems::getTableName(), 'rule_id');
    }

    /**
     * Get all of the product types that are assigned this rule.
     */
    public function product_types()
    {
        return $this->morphedByMany(HCECTypes::class, 'rulable', HCECPriceRulesAffectedItems::getTableName(), 'rule_id');
    }

    /**
     * Update morph relation
     *
     * @param array $data
     */
    public function updateRulable(array $data)
    {
        $this->affected_items()->forceDelete();

        $this->affected_items()->createMany(
            $this->getRulable($data)
        );
    }

    /**
     * Get formatted rulable
     *
     * @param $data
     * @return array
     */
    public function getRulable($data)
    {
        $rulable = [];

        foreach ( $data as $group => $items ) {
            if( $group == 'product_types' ) {
                if( $items ) {
                    foreach ( $items as $item ) {
                        $rulable[] = [
                            'rulable_id'   => $item,
                            'rulable_type' => HCECTypes::class,
                        ];
                    }
                }
            } else if( $group == 'categories' ) {
                if( $items ) {
                    foreach ( $items as $item ) {
                        $rulable[] = [
                            'rulable_id'   => $item,
                            'rulable_type' => HCECCategories::class,
                        ];
                    }
                }
            } else if( $group == 'goods' ) {
                if( $items ) {
                    foreach ( $items as $item ) {
                        $rulable[] = [
                            'rulable_id'   => $item,
                            'rulable_type' => HCECGoods::class,
                        ];
                    }
                }
            }
        }

        return $rulable;
    }
}