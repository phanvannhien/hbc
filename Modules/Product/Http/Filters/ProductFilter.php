<?php
namespace Modules\Product\Http\Filters;

use Modules\Pages\Entities\Products;
use Illuminate\Http\Request;
use App\Filters\QueryFilters;


class ProductFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function product_code( $s ) {
        return $this->builder->where('product_code','LIKE', '%'.$s.'%' );
    }

    public function product_cas( $s ) {
        return $this->builder->where('product_cas','LIKE', '%'.$s.'%' );
    }

    public function product_sku($s) {
        return $this->builder->where('product_sku','LIKE', '%'.$s.'%' );
    }

    public function product_name($s) {
        return $this->builder->where('product_name','LIKE', '%'.$s.'%' );
    }

    public function brand($s) {
        return $this->builder->where('brand','LIKE', '%'.$s.'%' );
    }

    public function category_id($s) {
        return $this->builder->where('category_id', $s );
    }

}