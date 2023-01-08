<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends _CrudController
{
    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'product_category_id' => [
                'type' => 'select',
                'lang' => 'general.product_category',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
            ],
            'name' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ]
            ],
            'desc' => [
                'type' => 'textarea',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'list' => 0
            ],
            'image' => [
                'type' => 'image',
                'path' => '/product',
                'list' => 0
            ],
            'status' => [
                'type' => 'select',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ]
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        parent::__construct(
            $request, 'general.product', 'product', 'Product', 'product',
            $passingData
        );

        $productCategory = [];
        foreach(ProductCategory::where('status', 80)->pluck('name', 'id')->toArray() as $key => $val) {
            $productCategory[$key] = $val;
        }

        $this->listView['index'] = env('ADMIN_TEMPLATE').'.page.product.list';

        $this->data['listSet'] = [
            'product_category_id' => $productCategory,
            'status' => get_list_active_inactive(),
        ];
    }

    public function dataTable()
    {
        $this->callPermission();

        $dataTables = new DataTables();

        $builder = $this->model::query()->select('*');

        if ($this->request->get('product_category_id') && $this->request->get('product_category_id') > 0) {
            $builder = $builder->where('product_category_id', intval($this->request->get('product_category_id')));
        }

        $dataTables = $dataTables->eloquent($builder)
            ->addColumn('action', function ($query) {
                return view($this->listView['dataTable'], [
                    'query' => $query,
                    'thisRoute' => $this->route,
                    'permission' => $this->permission,
                    'masterId' => $this->masterId
                ]);
            });

        $getResult = $this->renderDataTable($dataTables);
        $dataTables = $getResult['datatable'];
        $listRaw = $getResult['listRaw'];

        return $dataTables
            ->rawColumns($listRaw)
            ->make(true);
    }
}
