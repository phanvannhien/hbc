<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cities';

    public $timestamps = false;

    public $fillable = [
        'city_name',
        'code',
        'published',
        'ordering',
        'country_code',
        'country_id',
        'slug',
        'lat',
        'lng',
        'is_default',
    ];

    public function country(){
        return $this->belongsTo( Countries::class, 'country_code' );
    }
}
