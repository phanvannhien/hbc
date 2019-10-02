<?php
namespace Modules\Product\Http\Filters;

use Modules\Product\Entities\Order;
use Illuminate\Http\Request;
use App\Filters\QueryFilters;


class OrdersFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function id( $s ) {
        return $this->builder->where('orders.id', $s );
    }

    public function status( $s ) {
        return $this->builder->where('orders.status', $s );
    }

    public function name($s) {
        return $this->builder->where('users.name','LIKE', '%'.$s.'%' );
    }

    public function email($s) {
        return $this->builder->where('users.email','LIKE', '%'.$s.'%' );
    }

    public function created_at($s) {
        $arrDate = explode('-',$s);

        $start = str_replace('/','-', trim($arrDate[0]));
        $end = str_replace('/','-', trim($arrDate[1]));
        $st = \DateTime::createFromFormat('m-d-Y', $start);
        $ed = \DateTime::createFromFormat('m-d-Y', $end);

        return $this->builder
            ->where('orders.created_at','>=', $st->format('Y-m-d') )
            ->where('orders.created_at','<=', $ed->format('Y-m-d') );
    }
}