<?php

namespace Webkul\Admin\DataGrids\Quote;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Webkul\UI\DataGrid\DataGrid;
use Webkul\User\Repositories\UserRepository;

class QuoteDataGrid extends DataGrid
{
    use ProvideDropdownOptions;

    /**
     * User repository instance.
     *
     * @var \Webkul\User\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Create datagrid instance.
     *
     * @param \Webkul\User\Repositories\UserRepository  $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    /**
     * Place your datagrid extra settings here.
     *
     * @return void
     */
    // public function init()
    // {
    //     $this->setRowProperties([
    //         'backgroundColor' => '#ffd0d6',
    //         'condition' => function ($row) {
    //             if (Carbon::createFromFormat('Y-m-d H:i:s',  $row->expired_at)->endOfDay() < Carbon::now()) {
    //                 return true;
    //             }

    //             return false;
    //         }
    //     ]);
    // }

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('quotes')
            ->addSelect(
                'quotes.id',
                'quotes.subject',
                'quotes.payment_term',
                'quotes.expired_at',
                'quotes.grand_total',
                'quotes.created_at',
                'persons.id as person_id',
                'persons.name as person_name',
                'users.id as user_id',
                'users.name as pic_name',
                'users.email as pic_email',
                'quote_items.id as quote_item_id',
                'quote_items.name as quote_item_name',
            )
            ->leftJoin('quote_items', 'quote_items.quote_id', '=', 'quotes.id')
            ->leftJoin('users', 'quotes.user_id', '=', 'users.id')
            ->leftJoin('persons', 'quotes.person_id', '=', 'persons.id');

        $currentUser = auth()->guard('user')->user();

        if ($currentUser->view_permission != 'global') {
            if ($currentUser->view_permission == 'group') {
                $queryBuilder->whereIn('quotes.user_id', $this->userRepository->getCurrentUserGroupsUserIds());
            } else {
                $queryBuilder->where('quotes.user_id', $currentUser->id);
            }
        }

        $this->addFilter('person_name', 'persons.name');
        $this->addFilter('created_at', 'quotes.created_at');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('admin::app.quotes.created_at'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                return core()->formatDate($row->created_at, 'd M Y');
            },
        ]);

        $this->addColumn([
            'index'      => 'expired_at',
            'label'      => trans('admin::app.quotes.expired_at'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                return core()->formatDate($row->expired_at, 'd M Y');
            },
        ]);

        $this->addColumn([
            'index'    => 'subject',
            'label'    => trans('admin::app.quotes.subject'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'person_name',
            'label'    => trans('admin::app.contacts.persons.name'),
            'type'     => 'string',
            'sortable' => true,
            'closure'  => function ($row) {
                $route = urldecode(route('admin.contacts.persons.index', ['id[eq]' => $row->person_id]));

                return "<a href='" . $route . "'>" . $row->person_name . "</a>";
            },
        ]);

        $this->addColumn([
            'index'    => 'pic_name',
            'label'    => trans('admin::app.settings.users.title'),
            'type'     => 'string',
            'sortable' => true,
            'closure'  => function ($row) {
                $route = urldecode(route('admin.settings.users.index', ['id[eq]' => $row->user_id]));

                return "<a href='" . $route . "'>" . $row->pic_name . "</a>";
            },
        ]);

        $this->addColumn([
            'index'    => 'pic_email',
            'label'    => trans('admin::app.settings.users.pic_email'),
            'type'     => 'string',
            'sortable' => true,
            'closure'  => function ($row) {
                return $row->pic_email;
            },
        ]);

        $this->addColumn([
            'index'      => 'quote_item_name',
            'label'      => trans('admin::app.products.item_name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'payment_term',
            'label'      => trans('admin::app.quotes.payment_term'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'    => 'grand_total',
            'label'    => trans('admin::app.quotes.total'),
            'type'     => 'string',
            'sortable' => true,
            'closure'  => function ($row) {
                return "<p='" . '' . "'>" . 'RM' . number_format($row->grand_total, 2) . "</p>";
            },
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('ui::app.datagrid.view'),
            'method' => 'GET',
            'route'  => 'admin.quotes.view',
            'icon'   => 'eye-icon',
        ]);

        // $this->addAction([
        //     'title'  => trans('ui::app.datagrid.download'),
        //     'method' => 'GET',
        //     'route'  => 'admin.quotes.print',
        //     'icon'   => 'export-icon',
        // ]);

        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.quotes.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.quotes.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'user']),
            'icon'         => 'trash-icon',
        ]);
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'label'  => trans('ui::app.datagrid.delete'),
            'action' => route('admin.quotes.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}
