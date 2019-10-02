<?php

namespace Modules\Pages\Entities;

use Illuminate\Database\Eloquent\Model;

class PageTrans extends Model
{
    protected $fillable = [
        'content',
        'title',
        'slug',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'language',
    ];
    protected $table = 'pages_trans';


    public function page(){
        return $this->belongsTo( Page::class, 'page_id', 'id' );
    }

}
