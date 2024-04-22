<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    /**
     * View.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::join('photo', 'photo.product_id', '=', 'products.id')
            ->get([
                'products.id',
                'description',
                'external_code',
                'name',
                'price',
                'path'
            ])->toArray();
        $products = $this->array_unique_key($products, 'id');
        return view('index', compact('products'));
    }

    /**
     * Get unique array.
     *
     * @param array $array
     * @param string $key
     * @return array
     */
    function array_unique_key($array, $key)
    {
        $tmp = $key_array = array();
        $i   = 0;

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $tmp[$i]       = $val;
            }
            $i++;
        }
        return $tmp;
    }
}
