<?php namespace interactivesolutions\honeycombecommercepricerules\app\validators\ecommerce;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCPriceRulesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name'   => 'required',
            'from'   => 'required',
            'to'     => 'required',
            'type'   => 'required',
            'amount' => 'required',
        ];
    }
}