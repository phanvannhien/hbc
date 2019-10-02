<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class BlogCategoryTrans extends Model
{
    protected $fillable = [
        'category_id',
        'category_name',
        'category_slug',
        'category_description',
        'language',
    ];
    protected $table = 'categories_trans';
}
