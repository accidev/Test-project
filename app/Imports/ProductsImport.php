<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements  WithHeadingRow, ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
//    public function model(array $row)
//    {
////        return new Product([
////            'external_code' => $row['vnesnii_kod'],
////            'name'          => $row['naimenovanie'],
////            'description'   => $row['opisanie'],
////            'price'         => (float)$row['cena_cena_prodazi'],
////        ]);
//    }

    public function collection(Collection $collection)
    {

        return new Product($collection->toArray());
    }
}
