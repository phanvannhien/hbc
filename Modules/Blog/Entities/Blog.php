<?php

namespace Modules\Blog\Entities;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Filterable;
    protected $fillable = [];
}
