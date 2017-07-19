<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/price-rules'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.price.rules', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list'], 'uses' => 'ecommerce\\HCPriceRulesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_create'], 'uses' => 'ecommerce\\HCPriceRulesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.price.rules.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list'], 'uses' => 'ecommerce\\HCPriceRulesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.price.rules.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list'], 'uses' => 'ecommerce\\HCPriceRulesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.price.rules.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_update'], 'uses' => 'ecommerce\\HCPriceRulesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.price.rules.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.price.rules.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_force_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.price.rules.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list'], 'uses' => 'ecommerce\\HCPriceRulesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_update'], 'uses' => 'ecommerce\\HCPriceRulesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.price.rules.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_update'], 'uses' => 'ecommerce\\HCPriceRulesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.price.rules.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_create'], 'uses' => 'ecommerce\\HCPriceRulesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.price.rules.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_force_delete'], 'uses' => 'ecommerce\\HCPriceRulesController@apiForceDelete']);
        });
    });
});