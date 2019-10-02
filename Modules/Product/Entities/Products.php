<?php

namespace Modules\Product\Entities;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use Filterable;


    protected $table = 'products';
    protected $fillable = [];




    public function attributes(){
        return $this->hasMany( ProductAttributes::class, 'product_id','id' );
    }

    public function category(){
        return $this->belongsTo( CategoryProducts::class, 'category_id', 'id' );
    }



}
