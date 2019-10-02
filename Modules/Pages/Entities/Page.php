<?php

namespace Modules\Pages\Entities;

use App\Filters\Filterable;
use App\Traits\TranslateAble;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Filterable;
    use TranslateAble;

    protected $fillable = [];
    public $table = 'pages';



    public function trans(){
        return $this->hasMany( PageTrans::class, 'page_id', 'id' );
    }


}
