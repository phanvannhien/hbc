<?php
namespace App\Helpers;

use Modules\Product\Entities\CategoryProducts;




class Nestable{

    public $data = [];
    public $nestedData = [];

    public function __construct( $data )
    {

        $this->data = $data;
    }

    public function make_category(){
        $ref   = [];
        $items = [];

        for ( $i = 0; $i < count( $this->data ); $i++ ){

            $thisRef = &$ref[$this->data[$i]['id']];
            $thisRef['parent_id'] = $this->data[$i]['parent_id'];
            $thisRef['category_level'] = $this->data[$i]['category_level'];
            $thisRef['slug'] = $this->data[$i]['slug'];
            $thisRef['name'] = $this->data[$i]['name'];
            $thisRef['edit'] = $this->data[$i]['edit'];
            $thisRef['delete'] = $this->data[$i]['delete'];
            $thisRef['view'] = $this->data[$i]['view'];
            $thisRef['id'] = $this->data[$i]['id'];
            $thisRef['image'] = $this->data[$i]['image'];


            if( $this->data[$i]['parent_id'] == 0) {
                //$temp[$this->data[$i]['parent_id']] =  &$thisRef;
                $items[$this->data[$i]['id']] = &$thisRef;
            } else {
                $ref[$this->data[$i]['parent_id']]['child'][$this->data[$i]['id']] = &$thisRef;
            }
        }

        return $items;
    }



    public function categoryProduct(){
        $cat = CategoryProducts::join('category_product_trans','category_product_trans.category_id','=','category_product.id')
            ->where( 'category_product_trans.language', app()->getLocale())
            ->select('category_product.id','parent_id','category_name as name','category_slug as slug','category_image as image','category_level')
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
                'edit' => route('categories.edit', $c->id),
                'delete' => route('categories.destroy', $c->id),
                'view' => '#'
            ];
        }

        $this->data = $arrOut;
        return $this;
    }

    public function get(){
        $ref   = [];
        $items = [];

        for ( $i = 0; $i < count( $this->data ); $i++ ){

            $thisRef = &$ref[$this->data[$i]['id']];
            $thisRef['parent_id'] = $this->data[$i]['parent_id'];
            $thisRef['category_level'] = $this->data[$i]['category_level'];
            $thisRef['slug'] = $this->data[$i]['slug'];
            $thisRef['name'] = $this->data[$i]['name'];
            $thisRef['edit'] = $this->data[$i]['edit'];
            $thisRef['delete'] = $this->data[$i]['delete'];
            $thisRef['view'] = $this->data[$i]['view'];
            $thisRef['id'] = $this->data[$i]['id'];
            $thisRef['image'] = $this->data[$i]['image'];


            if( $this->data[$i]['parent_id'] == 0) {
                //$temp[$this->data[$i]['parent_id']] =  &$thisRef;
                $items[$this->data[$i]['id']] = &$thisRef;
            } else {
                $ref[$this->data[$i]['parent_id']]['child'][$this->data[$i]['id']] = &$thisRef;
            }
        }

        return $items;

    }


}