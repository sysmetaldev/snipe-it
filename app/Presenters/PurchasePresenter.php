<?php

namespace App\Presenters;

/**
 * Class PurchasePresenter
 */
class PurchasePresenter extends Presenter
{
    /**
     * Json Column Layout for bootstrap table
     * @return string
     */
    public static function dataTableLayout()
    {

        $layout = [
            [
                'field' => 'id',
                'searchable' => true,
                'sortable' => true,
                'switchable' => false,
                'title' => trans('general.order_number'),
                'visible' => true,
            ], [
                'field' => 'name',
                'searchable' => true,
                'sortable' => true,
                'switchable' => false,
                'title' => trans('general.title'),
                'visible' => true,
            ], [
                'field' => 'state',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('general.state'),
            ]
        ];
        return json_encode($layout);
    }

    /**
     * Pregenerated link to this accessories view page.
     * @return string
     */
    public function nameUrl()
    {
        return (string) link_to_route('accessories.show', $this->name, $this->id);
    }

    /**
     * Url to view this item.
     * @return string
     */
    public function viewUrl()
    {
        return route('accessories.show', $this->id);
    }

    public function name()
    {
        return $this->model->name;
    }
}
