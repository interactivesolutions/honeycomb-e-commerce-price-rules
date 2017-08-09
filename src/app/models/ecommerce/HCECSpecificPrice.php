<?php

namespace interactivesolutions\honeycombecommercepricerules\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\combinations\HCECCombinations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;

class HCECSpecificPrice extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_specific_price';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'goods_id', 'combination_id', 'reduction', 'reduction_type', 'date_from', 'date_to'];

    /**
     * Relation to model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goods()
    {
        return $this->belongsTo(HCECGoods::class, 'goods_id', 'id');
    }

    /**
     * Relation to model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function combination()
    {
        return $this->belongsTo(HCECCombinations::class, 'combination_id', 'id');
    }
}
