<?php

namespace interactivesolutions\honeycombecommercepricerules\app\forms\ecommerce\pricerules;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\pricerules\HCECDiscountCodes;

class HCECDiscountCodesForm
{
    // name of the form
    protected $formID = 'e-commerce-price-rules-discount-codes';

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
            'storageURL' => route('admin.api.routes.e.commerce.price.rules.discount.codes'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "user_id",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.user_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCUsers::get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 0,
                        "showNodes"              => ["email"],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "title",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "code",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.code"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "value"           => str_random(7),
                ],
                [
                    "type"            => "radioList",
                    "fieldID"         => "type",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.type"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    'options'         => HCECDiscountCodes::getTableEnumList('type', 'label', 'HCECommercePriceRules::e_commerce_price_rules_discount_codes.types.'),
                ],
                [
                    "type"            => "checkBoxList",
                    "fieldID"         => 'free_shipping',
                    "label"           => ' ',
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => [['id' => '1', 'label' => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.free_shipping")]],
                    "dependencies"    => [
                        [
                            'field_id'    => 'type',
                            'field_value' => 'none',
                        ],
                    ],
                ],
                [
                    "type"            => "checkBoxList",
                    "fieldID"         => 'shipping_included',
                    "label"           => ' ',
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => [['id' => '1', 'label' => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.shipping_included")]],
                    "dependencies"    => [
                        [
                            'field_id'    => 'type',
                            'field_value' => ['fixed', 'percentage'],
                        ],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "amount",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.amount"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "dependencies"    => [
                        [
                            'field_id'    => 'type',
                            'field_value' => ['fixed', 'percentage'],
                        ],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "total_available",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.total_available"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ],
                [
                    "type"            => "dateTimePicker",
                    "fieldID"         => "valid_from",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.valid_from"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "properties"      => [
                        "format" => "YYYY-MM-DD HH:mm:ss",
                    ],
                ],
                [
                    "type"            => "dateTimePicker",
                    "fieldID"         => "valid_to",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.valid_to"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "properties"      => [
                        "format" => "YYYY-MM-DD HH:mm:ss",
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "minimum_amount",
                    "label"           => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.minimum_amount"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "note"            => trans("HCECommercePriceRules::e_commerce_price_rules_discount_codes.discount_applies"),
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