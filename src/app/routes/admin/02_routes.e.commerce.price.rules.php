<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/price-rules', ['as' => 'admin.routes.e.commerce.price.rules.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list'], 'uses' => 'ecommerce\\HCPriceRulesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/price-rules'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.price.rules', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list'], 'uses' => 'ecommerce\\HCPriceRulesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_create'], 'uses' => 'ecommerce\\HCPriceRulesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.price.rules.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list'], 'uses' => 'ecommerce\\HCPriceRulesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.price.rules.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_update'], 'uses' => 'ecommerce\\HCPriceRulesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.price.rules.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_create', 'acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.price.rules.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_force_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.price.rules.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list'], 'uses' => 'ecommerce\\HCPriceRulesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_update'], 'uses' => 'ecommerce\\HCPriceRulesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.price.rules.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_update'], 'uses' => 'ecommerce\\HCPriceRulesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.price.rules.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list', 'acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_create'], 'uses' => 'ecommerce\\HCPriceRulesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.price.rules.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_force_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiForceDelete']);
        });
    });
});
