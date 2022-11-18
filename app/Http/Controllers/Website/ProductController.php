<?php

namespace App\Http\Controllers\Website;

use App\Codes\Logic\WebController;
use App\Codes\Models\Product;
use Illuminate\Http\Request;

class ProductController extends WebController
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

        if(!isset($data['page']['product'])) {
            return redirect()->route('404');
        }

        $getProduct = Product::where('status', 80)->get();

        $data['product'] = $getProduct ?? [];

        return view(env('WEBSITE_TEMPLATE').'.page.product', $data);
    }

}
