<?php

namespace Modules\Blog\Entities;

use App\Traits\TranslateAble;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use TranslateAble;
    protected $fillable = [];

    protected $table = 'categories';

    public function trans(){
        return $this->hasMany( BlogCategoryTrans::class, 'category_id', 'id' );
    }

    public static function get_cat(){
        $cat = self::join('categories_trans','categories_trans.category_id','=','categories.id')
            ->where( 'categories_trans.language', app()->getLocale())
            ->select('categories.id',
                'parent_id',
                'category_name as name',
                'category_slug as slug',
                'category_image as image',
                'category_level')
            ->get();

        $arrOut = [];
        foreach ( $cat as $c ){
            $arrOut[] = [
                'id' => $c->id,
                'parent_id' => $c->parent_id,
                'slug' => $c->slug,
                'category_level' => $c->category_level,
                'name' => $c->name,
                'image' => $c->image,
                'edit' => route('blog_categories.edit', $c->id),
                'delete' => route('blog_categories.destroy', $c->id),
                'view' => '#'
            ];
        }

        return $arrOut;
    }



}
