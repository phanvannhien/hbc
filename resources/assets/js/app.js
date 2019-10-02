
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('flexslider');
import swal from 'sweetalert2/dist/sweetalert2.js'

import 'sweetalert2/src/sweetalert2.scss'



// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });


function showCompareButton(){
    if( $('#compare-product-items .compare-item' ).length > 2 ){

    }
}


$(document).ready(function(){
    $('.flexslider').flexslider({
        controlNav: false
    });


    $('.btn-add-cart-ajax').on('click', function(e){
        e.preventDefault();
        var form = $(this).closest('form');
        $.ajax({
            url: $(form).attr('action'),
            method: 'post',
            dataType: 'json',
            data: form.serializeArray(),
            beforeSend: function(){
                $('body').addClass('loading');
            },
            success: function( response ){
                $('body').removeClass('loading');
                if( response.ok ){
                    swal({
                      title: 'Success!',
                      type: 'success',
                      confirmButtonText: 'OK'
                    });
                    $('#mini-cart-price').html( response.cart_total );

                }

            }
        });
    });


    $('#mini-cart').parent().on('shown.bs.dropdown', function () {
        $.ajax({
            url: '/cart/mini',
            type: 'get',
            beforeSend: function () {

            },
            success: function ( response ) {
                $('#mini-cart').html( response );
            },
            error: function(  jqXHR ){

            }
        });
    });



    $('select[name="address_id"]').on('change', function (event) {
        //alert(event.type + ' callback');
        if( $(this).val() == '0' ){
            $('#new-address').collapse("show");
        }else{
            $('#new-address').collapse("hide");
        }
    });


    var selected_address = $('select[name="address_id"]');
    console.log(selected_address);
    if( selected_address ){
        if( $(selected_address).val() == '0' ){
            $('#new-address').collapse("show");
        }else{
            $('#new-address').collapse("hide");
        }
    }


    // $('#frm-search input[type="text"]').on('invalid', function(e){
    //     e.preventDefault();
    //
    // });


    $(document).click(function(){
        $('#search-results').hide();
    });

    $('#frm-search input[type="text"]').click(function(){
        $('#search-results').show();
    });
    $('#frm-search input[type="text"]').focus(function(){
        $('#search-results').show();
    });

    $('#search-results, #frm-search').click(function(e){
        e.stopPropagation();
    });


    $('#frm-search input[type="text"]').keyup(function (e) {

        e.preventDefault();
        console.log($(this).val());

        if( $(this).val().length > 3 ){

            $.ajax({
                url: '/search',
                type: 'get',
                data: {
                    s: $(this).val()
                },
                beforeSend: function () {

                },
                success: function ( response ) {
                    $('#search-results').html( response );
                    $('#search-results').show();
                },

            });
        }else{

        }
    });


    $('.add-compare').on('change', function (e) {
        e.preventDefault();
        var product_image = $(this).attr('data-img');
        var product_code = $(this).val();
        var that = this;
        if($(this).is(':checked')){

            $.ajax({
                url: '/compare',
                method : 'get',
                dataType: 'json',
                data: {
                    product_code: product_code,
                    action: 'add',
                },
                beforeSend: function(){
                    $('body').addClass('loading');
                },
                success: function ( response ) {
                    $('body').removeClass('loading');
                    if( response.success ){
                        var html = '<div id="'+product_code+'" class="col-md-3 compare-item"><div class="text-center border border-primary">' +
                        '<img src="'+product_image+'" alt="">' +
                        '<p><span>'+product_code+'</span></p>' +
                        '</div>' +
                        '<a href="#" data-id="'+product_code+'" class="remove-compare-item"><i class="fa fa-trash"></i></a>' +
                        '</div>';
                        $('#compare-product-items').append( html );
                    }else{
                        swal({
                          title: 'Error!',
                          type: 'error',
                          text: response.msg,
                          confirmButtonText: 'OK'
                        });
                        $(that).prop('checked', false);
                    }
                    

                }
            });

        }else{

            $.ajax({
                url: '/compare',
                method : 'get',
                dataType: 'json',
                data: {
                    product_code: product_code,
                    action: 'remove',
                },
                beforeSend: function(){
                    $('body').addClass('loading');
                },
                success: function () {
                    $('body').removeClass('loading');
                    $('#compare-product-items div#'+product_code ).remove();

                }
            });

            
        }



    });

    $('#compare-product-wrap').on('click','.remove-compare-item', function (e) {
        var product_code = $(this).attr('data-id');
        var that = this;
        $.ajax({
            url: '/compare',
            method : 'get',
            dataType: 'json',
            data: {
                product_code: product_code ,
                action: 'remove',
            },
            beforeSend: function(){
                $('body').addClass('loading');
            },
            success: function () {
                $('body').removeClass('loading');
                $(that).closest('.compare-item').remove();
                $('input#check-item-'+product_code ).prop( "checked", false );

            }
        });

    });


    
    
    function ajax_add_compare( product_code ) {

    }




});

