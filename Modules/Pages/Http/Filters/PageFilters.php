<?php
namespace Modules\Pages\Http\Filters;

use Modules\Pages\Entities\Page;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Filters\QueryFilters;


class PageFilters extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function title( $s ) {

        return $this->builder->where('pages_trans.title', 'LIKE', "%$s%");

    }



    public function status($s) {

        return $this->builder->where('pages.status', $s );
    }


}