<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryProductTrans extends Model
{
    protected $table = 'category_product_trans';
    protected $fillable = [
        'category_id',
        'category_name',
        'category_slug',
        'category_description',
        'language',
    ];
}
