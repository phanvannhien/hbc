<?php
namespace Modules\Blog\Http\Filters;

use Illuminate\Http\Request;
use App\Filters\QueryFilters;


class PostFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function post_title( $s ) {
        return $this->builder->where('post_trans.post_title', 'LIKE', "%$s%");

    }


}