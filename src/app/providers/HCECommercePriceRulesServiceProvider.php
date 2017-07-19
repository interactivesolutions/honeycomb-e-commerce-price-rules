<?php

namespace interactivesolutions\honeycombecommercepricerules\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCECommercePriceRulesServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombecommercepricerules\app\http\controllers';

    public $serviceProviderNameSpace = 'HCECommercePriceRules';
}





