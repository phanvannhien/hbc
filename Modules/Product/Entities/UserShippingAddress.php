<?php

namespace Modules\Product\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserShippingAddress extends Model
{
    protected $fillable = [];

    protected $table = 'address_book';
    public $timestamps = false;

    public function getAddress(){
        $add = $this->join('province','province.id','=', 'address_book.province_id' )
            ->join('district','district.id','=', 'address_book.district_id' )
            ->join('ward','ward.id','=', 'address_book.ward_id' )
            ->join('countries','countries.id','=', 'address_book.country_id' )
            ->where( 'address_book.province_id', $this->province_id )
            ->where( 'address_book.districtid', $this->district_id )
            ->where( 'address_book.wardid', $this->ward_id )
            ->select('province.name as p_name', 'district.name as d_name', 'ward.name as w_name'  )
            ->first();

        if( $add )
            return $this->address.' '.$add->w_name.' '.$add->p_name.' '.$add->p_name;
    }



    public function user(){
        return $this->belongsTo( User::class, 'user_id' );
    }



}
