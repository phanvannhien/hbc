<?php

namespace Modules\Product\Entities;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\User;


class Order extends Model
{
    use Filterable;
    protected $table = 'orders';
    protected $fillable = [];

    public function detail(){
        return $this->hasMany( OrderDetails::class, 'order_id' );
    }

    public function getTotalNumber(){
        return $this->detail()->sum('sub_total');
    }

    public function getTotal(){
        $total = $this->detail()->sum('sub_total');
        return number_format( $total).' '.config('app.price_suffix');
    }

    public function user(){
        return $this->belongsTo( User::class, 'user_id' );
    }



    public function shipping(){
        return $this->belongsTo( UserShippingAddress::class, 'address_id' );
    }


}
