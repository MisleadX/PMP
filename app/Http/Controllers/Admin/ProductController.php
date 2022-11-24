<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\ProductCategory;
use Illuminate\Http\Request;

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
                'validate' => [
                    'create' => 'required',
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
            $request, 'general.product', 'product', 'Product', 'product',
            $passingData
        );

        $productCategory = [];
        foreach(ProductCategory::where('status', 80)->pluck('name', 'id')->toArray() as $key => $val) {
            $productCategory[$key] = $val;
        }

        $this->data['listSet'] = [
            'product_category_id' => $productCategory,
            'status' => get_list_active_inactive(),
        ];
    }
}
