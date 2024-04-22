<?php

namespace App\Http\Controllers;

use App\Models\Additional_property;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * View.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function showProduct($id)
    {
        $product           = Product::where('id', $id)->first();
        $productProperties = Additional_property::where('product_id', $id)->first();
        $photos            = Photo::where('product_id', $id)->get();
        return view('product', compact('product', 'productProperties', 'photos'));
    }
}
