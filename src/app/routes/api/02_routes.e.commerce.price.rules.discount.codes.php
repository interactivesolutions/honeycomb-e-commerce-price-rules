<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/price-rules/discount-codes'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_create'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_update'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_force_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_update'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_update'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_create'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.price.rules.discount.codes.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_discount_codes_force_delete'], 'uses' => 'ecommerce\\pricerules\\HCECDiscountCodesController@apiForceDelete']);
        });
    });
});