<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_detail';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_sku',
        'qty',
        'price',
        'sub_total',
    ];

    public function product(){
        return $this->belongsTo( Products::class, 'product_id' );
    }


    public function getSubTotal(){
        return number_format( $this->sub_total ). ' ' . config('app.price_suffix');
    }

    public function getPriceFormat(){
        return number_format($this->price ) . ' ' . config('app.price_suffix');
    }

    public function order(){
        return $this->belongsTo( Order::class, 'order_id' );
    }



}
