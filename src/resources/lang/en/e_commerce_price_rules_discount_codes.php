<?php

return [
    'page_title'        => 'Discount codes',
    'user_id'           => 'User',
    'title'             => 'Title',
    'code'              => 'Code',
    'type'              => 'Type',
    'shipping_included' => 'Shipping included',
    'free_shipping'     => 'Free shipping',
    'amount'            => 'Amount',
    'total_available'   => 'Total available',
    'valid_from'        => 'Valid from',
    'valid_to'          => 'Valid to',
    'minimum_amount'    => 'Minimum amount',

    'discount_applies' => 'Discount applies from given sum. I.E. from 10 Eur. Default is 0',

    'types' => [
        'percentage' => 'Percentage',
        'fixed'      => 'Fixed price',
        'none'       => 'No discount',
    ],

    'percentage_discount_with_shipping'    => 'Discount :amount% to all cart',
    'percentage_discount_without_shipping' => 'Discount :amount% to cart products',
    'fixed_discount_with_shipping'         => 'Discount -:amount€ to all cart',
    'fixed_discount_without_shipping'      => 'Discount -:amount€ to cart products',
    'none_discount'                        => 'Free shipping',
];