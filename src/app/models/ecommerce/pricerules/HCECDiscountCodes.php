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
     * @return mixed
     */
    public function isAvailable()
    {
        $now = Carbon::now()->toDateTimeString();

        return $this->valid_from <= $now && $this->valid_to > $now && $this->total_available;
    }

    /**
     * Is not active discount
     *
     * @return mixed
     */
    public function isNotAvailable()
    {
        return ! $this->isAvailable();
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

    /**
     * Relation to cart discount
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart_discount()
    {
        return $this->belongsTo(HCECCartDiscountCode::class, 'discount_code_id', 'id');
    }

    /**
     * Discount text
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function discountText()
    {
        if( $this->type == 'percentage' ) {
            if( $this->shipping_included ) {
                $text = trans('HCECommercePriceRules::e_commerce_price_rules_discount_codes.percentage_discount_with_shipping', ['amount' => $this->amount]);
            } else {
                $text = trans('HCECommercePriceRules::e_commerce_price_rules_discount_codes.percentage_discount_without_shipping', ['amount' => $this->amount]);
            }
        } else if( $this->type == 'fixed' ) {
            if( $this->shipping_included ) {
                $text = trans('HCECommercePriceRules::e_commerce_price_rules_discount_codes.fixed_discount_with_shipping', ['amount' => $this->amount]);
            } else {
                $text = trans('HCECommercePriceRules::e_commerce_price_rules_discount_codes.fixed_discount_without_shipping', ['amount' => $this->amount]);
            }
        } else {
            $text = trans('HCECommercePriceRules::e_commerce_price_rules_discount_codes.none_discount');
        }

        return $text;
    }
}