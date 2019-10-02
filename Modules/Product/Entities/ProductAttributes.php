<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    protected $table = 'product_attributes';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'attribute_id',
        'attribute_value',
        'price',
        'sku',
        'availability',
    ];


    public function getPriceFormat(){
        return number_format($this->price ) . ' ' . config('app.price_suffix');
    }

    public function getPriceHtml(){
        return number_format($this->price).' VND';
    }


    public function parent_product(){
        return $this->belongsTo( Products::class, 'product_id','id' );
    }

}
