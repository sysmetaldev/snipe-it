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
                'field' => 'name',
                'searchable' => true,
                'sortable' => true,
                'switchable' => true,
                'title' => trans('general.title'),
                'visible' => true,
            ],
            [
                'field' => 'id',
                'searchable' => true,
                'sortable' => true,
                'switchable' => true,
                'title' => trans('general.order_number'),
                'visible' => true,
            ],
            [
                'field' => 'state',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('general.state_name'),
            ],
            [
                'field' => 'user',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('general.user'),
                'formatter' => 'usersLinkObjFormatter',
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
