<?php

namespace interactivesolutions\honeycombecommercepricerules\app\forms\ecommerce;

use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\HCECPriceRules;

class HCPriceRulesForm
{
    // name of the form
    protected $formID = 'e-commerce-price-rules';

    // is form multi language
    protected $multiLanguage = 0;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.routes.e.commerce.price.rules'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "singleLine",
                    "fieldID"         => "name",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules.name"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ],
                [
                    "type"            => "dateTimePicker",
                    "fieldID"         => "from",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules.from"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "properties"      => [
                        "format" => "YY-MM-D HH:mm:ss",
                    ],
                ],
                [
                    "type"            => "dateTimePicker",
                    "fieldID"         => "to",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules.to"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "properties"      => [
                        "format" => "YY-MM-D HH:mm:ss",
                    ],
                ],
                [
                    "type"            => "radioList",
                    "fieldID"         => "type",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules.type"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    'options'         => HCECPriceRules::getTableEnumList('type', 'label'),
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "amount",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules.amount"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ],
            ],
        ];

        if( $this->multiLanguage )
            $form['availableLanguages'] = getHCContentLanguages();

        if( ! $edit )
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }
}