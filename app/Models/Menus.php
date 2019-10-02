<?php

namespace App\Models;

use App\Traits\TranslateAble;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{

    protected $table = 'menus';

    public $fillable = ['menu_code','menu_title'];

    public function menu_items(){
        return $this->hasMany( MenuItems::class, 'menu_id', 'id' );
    }
}
