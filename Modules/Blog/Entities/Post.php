<?php

namespace Modules\Blog\Entities;

use App\Filters\Filterable;
use App\Traits\TranslateAble;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Filterable;
    use TranslateAble;
    protected $table = 'blogs';
    protected $fillable = [];

    public function trans(){
        return $this->hasMany( PostTrans::class, 'post_id' );
    }
}
