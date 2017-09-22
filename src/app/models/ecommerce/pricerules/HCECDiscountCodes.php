<?php

namespace interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\pricerules;

use Carbon\Carbon;
use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECCartDiscountCode;

class HCECDiscountCodes extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_discount_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'title', 'code', 'type', 'shipping_included', 'free_shipping', 'amount', 'total_available', 'valid_from', 'valid_to', 'minimum_amount'];

    /**
     * User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(HCUsers::class, 'user_id', 'id');
    }

    /**
     * Is active discount
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsActive($query)
    {
        $now = Carbon::now()->toDateTimeString();

        return $query->where(function ($query) use ($now) {
            $query->where('valid_from', '<=', $now)->where('valid_to', '>', $now);
        });
    }

    /**
     * Is active discount
     *
     * @param $query
     * @return mixed
     */
    public function scopeAvailable($query)
    {
        return $query->where(function ($query) {
            $query->isActive()->where('total_available', '>', 0);
        });
    }

    /**
     * Discount carts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart()
    {
        return $this->belongsToMany(HCECDiscountCodes::class, HCECCartDiscountCode::getTableName(), 'discount_code_id', 'cart_id')->withTimestamps();
    }
}