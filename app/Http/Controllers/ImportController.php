<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

set_time_limit(180);

class ImportController extends Controller
{
    /**
     * View.
     *
     * @return Application|Factory|View
     */
    public function import()
    {
        return view('import');
    }

    /**
     * Import File from page in db
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function fileImport(Request $request)
    {
        $file = $request->file('file');
        try {
            $products = Excel::toArray(new ProductsImport(), $file);
            $products = call_user_func_array('array_merge', $products);
            $codes    = Product::all('external_code');
            foreach ($products as $product) {
                $productPhotos = explode(", ", $product['dop_pole_ssylki_na_foto']);
                $packagePhotos = explode(", ", $product['dop_pole_ssylka_na_upakovku']);
                if ($codes->where('external_code', $product['vnesnii_kod'])->count() == 0) {
                    $productId = DB::table("products")->insertGetId($this->returnArrayForProductTable($product));
                    DB::table("additional_properties")->insert($this->returnArrayForAdditionalTable($product, $productId));
                } else {
                    DB::table("products")->where('external_code', $product['vnesnii_kod'])->update($this->returnArrayForProductTable($product));
                    $productId = DB::table("products")->get()->where("external_code", $product['vnesnii_kod'])->first()->id;
                    DB::table("additional_properties")->where('product_id', $productId)->update($this->returnArrayForAdditionalTable($product, $productId));
                    $oldPhotosPath = Photo::all()->where("product_id", $productId);
                    foreach ($oldPhotosPath as $photoPath) {
                        unlink($photoPath['path']);
                    }
                    DB::table('photo')->where('product_id', $productId)->delete();
                }
                foreach ($packagePhotos as $photo) {
                    $this->importPhoto($photo, $productId);
                }
                foreach ($productPhotos as $photo) {
                    $this->importPhoto($photo, $productId);
                }
            }
        } catch (\Exception) {
            return back()->with('error', 'Products not imported.');
        }
        return back()->with('success', 'Products imported successfully.');
    }

    /**
     * Import photos to db.
     *
     * @param string $photo
     * @param int $productId
     * @return void
     */
    public function importPhoto($photo, $productId)
    {
        $filename      = Str::random(30);
        $filename      = './img/' . $filename . '.jpg';
        $ch            = curl_init($photo);
        $save_file_loc = $filename;
        $fp            = fopen($save_file_loc, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        DB::table("photo")->insert([
            'path'       => $filename,
            'link'       => $photo,
            'product_id' => $productId,
        ]);
    }

    /**
     * Return often use array.
     *
     * @param $product
     * @param int $productId
     * @return array
     */
    public function returnArrayForAdditionalTable($product, $productId)
    {
        return [
            'size'                => $product['dop_pole_razmer'],
            'color'               => $product['dop_pole_cvet'],
            'brand'               => $product['dop_pole_brend'],
            'composition'         => $product['dop_pole_sostav'],
            'quantity_in_package' => $product['dop_pole_kol_vo_v_upakovke'],
            'seo_title'           => $product['dop_pole_seo_title'],
            'seo_h1'              => $product['dop_pole_seo_h1'],
            'seo_description'     => $product['dop_pole_seo_description'],
            'product_weight'      => $product['dop_pole_ves_tovarag'],
            'product_width'       => $product['dop_pole_sirinamm'],
            'product_height'      => $product['dop_pole_vysotamm'],
            'product_length'      => $product['dop_pole_dlinamm'],
            'package_weight'      => $product['dop_pole_ves_upakovkig'],
            'package_width'       => $product['dop_pole_sirina_upakovkimm'],
            'package_height'      => $product['dop_pole_vysota_upakovkimm'],
            'package_length'      => $product['dop_pole_dlina_upakovkimm'],
            'product_category'    => $product['dop_pole_kategoriia_tovara'],
            'product_id'          => $productId
        ];
    }

    /**
     * Return often use array.
     *
     * @param $product
     * @return array
     */
    public function returnArrayForProductTable($product)
    {
        return [
            'name'          => $product['naimenovanie'],
            'description'   => $product['opisanie'],
            'price'         => (float)$product['cena_cena_prodazi'],
            'external_code' => $product['vnesnii_kod'],
        ];
    }
}
