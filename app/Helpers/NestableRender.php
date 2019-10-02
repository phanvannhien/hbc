<?php
namespace App\Helpers;


class NestableRender{

    public static function renderHtml( $items, $class = 'dd-list-cat'  ){
        $html = "<ul class=\"".$class."\" >";
        foreach($items as $key => $value) {
            $html.= '<li class="dd-item" data-id="'.$value['id'].'" >
                <div class="dd3-content clearfix">
                    <img width="30" src="'.$value['image'].'" alt="">
                  
                    <div class="content-left">
                        <p class="pull-right">
                            <a class="btn btn-sm btn-primary" id="'.$value['id'].'" href="'.$value['edit'].'" ><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" id="'.$value['id'].'" href="'.$value['delete'].'"><i class="fa fa-trash"></i></a>
                        </p>
                        <p id="label_show'.$value['id'].'">'.$value['name'].'</p>
                        
                    </div>
                </div>';
            if(array_key_exists('child',$value)) {
                $html .= self::renderHtml($value['child'],'child');
            }
            $html .= "</li>";
        }
        $html .= "</ul>";
        return $html;
    }


    public static function renderMenuCategories( $items, $class = 'category-menu'  ){

        $html = "<ul class=\"".$class."\" >";
        foreach($items as $key => $value) {
            $html .= '<li class="" data-id="'.$value['id'].'" >';
            $html .= '<a href="'.route('front.category', [ 'slug' => $value['slug'] , 'id' => $value['id']]).'">'.$value['name'].'</a>';
            if(array_key_exists('child',$value)) {
                $html .= self::renderMenuCategories($value['child'],'child');
            }
            $html .= "</li>";
        }
        $html .= "</ul>";
        return $html;
    }



    public static function renderSelect( $items, $selected = ''){

        $html = "";
        foreach($items as $key => $value) {

            $att = ( $value['id'] == $selected ) ? 'selected' : '';

            $spe = '';
            for( $i = 1; $i <= $value['category_level']; $i++ ){
                $spe .= '&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $html.= '<option '.$att.' value="'.$value['id'].'">'.$spe.$value['name'].'</option>';
            if(array_key_exists('child',$value)) {
                $html .= self::renderSelect($value['child'], $selected );
            }
        }
        return $html;

    }


}