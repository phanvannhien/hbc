<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use TranslateAble;
    protected $table = 'menu_items';

    public $fillable = [
        'menu_id',
        'parent_id',
        'menu_order',
        'menu_level',
        'menu_link',
        'type',
        'menu_status',
    ];


    public function menu(){
        return $this->belongsTo( Menus::class, 'menu_id', 'id' );
    }

}
