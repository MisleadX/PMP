<?php

namespace App\Http\Controllers\Website;

use App\Codes\Logic\WebController;
use App\Codes\Models\Product;
use App\Codes\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends WebController
{
    protected $data;
    protected $request;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index($category)
    {
        $data = $this->data;

        if(!isset($data['page']['product'])) {
            return redirect()->route('404');
        }

        $getCategory = ProductCategory::where('name', $category)->first();

        $getProduct = Product::where('status', 80)->where('product_category_id', $getCategory->id)->get();

        $getOtherCategory = ProductCategory::where('id', '!=', $getCategory->id)->limit(5)->get();

        $data['other_category'] = $getOtherCategory ?? [];
        $data['category'] = $getCategory ?? [];
        $data['product'] = $getProduct ?? [];

        return view(env('WEBSITE_TEMPLATE').'.page.product', $data);
    }

}
