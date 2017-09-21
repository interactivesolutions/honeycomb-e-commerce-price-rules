<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/price-rules/discount-codes', ['as' => 'admin.routes.e.commerce.price.rules.discount.codes.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/price-rules/discount-codes'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.price.rules.discount.codes', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_create'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.price.rules.discount.codes.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.price.rules.discount.codes.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_update'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_create', 'acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.price.rules.discount.codes.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_force_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.price.rules.discount.codes.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_update'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.price.rules.discount.codes.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_update'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.price.rules.discount.codes.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list', 'acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_create'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.price.rules.discount.codes.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_force_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiForceDelete']);
        });
    });
});
