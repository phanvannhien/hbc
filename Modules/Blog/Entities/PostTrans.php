<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class PostTrans extends Model
{
    protected $table = 'post_trans';
    protected $fillable = [
        'post_content',
        'post_title',
        'post_slug',
        'post_excerpt',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'language',
    ];
}
