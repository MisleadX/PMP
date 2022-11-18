<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use Illuminate\Http\Request;

class ProductCategoryController extends _CrudController
{
    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ]
            ],
            'image' => [
                'type' => 'image',
                'path' => '/product_category',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
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
            $request, 'general.product_category', 'product-category', 'ProductCategory', 'product-category',
            $passingData
        );

        $this->data['listSet'] = [
            'status' => get_list_active_inactive(),
        ];
    }
}
