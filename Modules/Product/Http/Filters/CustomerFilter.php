<?php
namespace Modules\Product\Http\Filters;

use App\User;
use Illuminate\Http\Request;
use App\Filters\QueryFilters;


class CustomerFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function name( $s ) {
        return $this->builder->where('name','LIKE', '%'.$s.'%' );
    }

    public function email($s) {
        return $this->builder->where('email','LIKE', '%'.$s.'%' );
    }


}