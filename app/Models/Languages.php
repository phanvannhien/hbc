<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $connection = 'mysql';
    protected $table = 'languages';
//    public $incrementing = false;
    protected $primaryKey = 'code';
    protected $fillable = ['active','name','icon'];
    public $timestamps = false;

}
