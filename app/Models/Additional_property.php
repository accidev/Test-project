<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional_property extends Model
{
    use HasFactory;

    protected $table = 'additional_properties';
    protected $fillable =
        [
            'size',
            'color',
            'brand',
            'composition',
            'quantity_in_package',
            'seo_title',
            'seo_h1',
            'seo_description',
            'product_weight',
            'product_width',
            'product_height',
            'product_length',
            'package_weight',
            'package_width',
            'package_height',
            'package_length',
            'product_category',
            'product_id'
        ];

    public $timestamps = false;
}
