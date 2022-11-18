<?php

namespace App\Http\Controllers\Website;

use App\Codes\Logic\WebController;
use App\Codes\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends WebController
{
    protected $data;
    protected $request;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index()
    {
        $data = $this->data;

        if(!isset($data['page']['product-category'])) {
            return redirect()->route('404');
        }

        $getProductCategory = ProductCategory::where('status', 80)->get();

        $data['product_category'] = $getProductCategory ?? [];

        return view(env('WEBSITE_TEMPLATE').'.page.product_category', $data);
    }

}
