<?php

namespace interactivesolutions\honeycombecommercepricerules\app\http\controllers\ecommerce;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\HCECPriceRules;
use interactivesolutions\honeycombecommercepricerules\app\validators\ecommerce\HCPriceRulesValidator;

class HCPriceRulesController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title'       => trans('HCECommercePriceRules::e_commerce_price_rules.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.price.rules'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-price-rules-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-price-rules-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_price_rules_routes_e_commerce_price_rules_delete') )
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters();

        return hcview('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'name'   => [
                "type"  => "text",
                "label" => trans('HCECommercePriceRules::e_commerce_price_rules.name'),
            ],
            'from'   => [
                "type"  => "text",
                "label" => trans('HCECommercePriceRules::e_commerce_price_rules.from'),
            ],
            'to'     => [
                "type"  => "text",
                "label" => trans('HCECommercePriceRules::e_commerce_price_rules.to'),
            ],
            'type'   => [
                "type"  => "text",
                "label" => trans('HCECommercePriceRules::e_commerce_price_rules.type'),
            ],
            'amount' => [
                "type"  => "text",
                "label" => trans('HCECommercePriceRules::e_commerce_price_rules.amount'),
            ],

        ];
    }

    /**
     * Create item
     *
     * @return mixed
     */
    protected function __apiStore()
    {
        $data = $this->getInputData();

        $record = HCECPriceRules::create(array_get($data, 'record'));

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __apiUpdate(string $id)
    {
        $record = HCECPriceRules::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record', []));

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict(string $id)
    {
        HCECPriceRules::where('id', $id)->update(request()->all());

        return $this->apiShow($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiDestroy(array $list)
    {
        HCECPriceRules::destroy($list);

        return hcSuccess();
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiForceDelete(array $list)
    {
        HCECPriceRules::onlyTrashed()->whereIn('id', $list)->forceDelete();

        return hcSuccess();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed
     */
    protected function __apiRestore(array $list)
    {
        HCECPriceRules::whereIn('id', $list)->restore();

        return hcSuccess();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    protected function createQuery(array $select = null)
    {
        $with = [];

        if( $select == null )
            $select = HCECPriceRules::getFillableFields();

        $list = HCECPriceRules::with($with)->select($select)
            // add filters
            ->where(function ($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->search($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param Builder $query
     * @param string $phrase
     * @return Builder
     */
    protected function searchQuery(Builder $query, string $phrase)
    {
        return $query->where(function (Builder $query) use ($phrase) {
            $query->where('name', 'LIKE', '%' . $phrase . '%')
                ->orWhere('from', 'LIKE', '%' . $phrase . '%')
                ->orWhere('to', 'LIKE', '%' . $phrase . '%')
                ->orWhere('type', 'LIKE', '%' . $phrase . '%')
                ->orWhere('amount', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCPriceRulesValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.name', array_get($_data, 'name'));
        array_set($data, 'record.from', array_get($_data, 'from'));
        array_set($data, 'record.to', array_get($_data, 'to'));
        array_set($data, 'record.type', array_get($_data, 'type'));
        array_set($data, 'record.amount', array_get($_data, 'amount'));

        return $data;
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function apiShow(string $id)
    {
        $with = [];

        $select = HCECPriceRules::getFillableFields();

        $record = HCECPriceRules::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        return $filters;
    }
}
