$(document).ready(function (){
    $('#mns_login').addClass('alert alert-success display-none');
    $('#mns_items_producto').addClass('alert alert-success display-none');
    $('#msn_item-group').addClass('alert alert-success display-none');
    $('#msn_item-three').addClass('alert alert-success display-none');
    $('#msn_business_partner').addClass('alert alert-success display-none');
    
    $(document).on('click','#btn_sinc_login',function(){
        $('#mns_login').removeClass('display-none');
        $('#btn_sinc_login').hide();
        $('#btn_sinc_producto').hide();
        $('#btn_sinc_precio_costo').hide();
        $('#btn_sinc_oitb').hide();
        $('#btn_item-three').hide();
        $('#btn_business_partner').hide();
    });

    $(document).on('click','#btn_sinc_producto',function(){
        $('#mns_items_producto').removeClass('display-none');
        $('#btn_sinc_login').hide();
        $('#btn_sinc_producto').hide();
        $('#btn_sinc_precio_costo').hide();
        $('#btn_sinc_oitb').hide();
        $('#btn_item-three').hide();
        $('#btn_business_partner').hide();
    });

    $(document).on('click','#btn_sinc_precio_costo',function(){
        $('#mns_items_producto').removeClass('display-none');
        $('#btn_sinc_login').hide();
        $('#btn_sinc_producto').hide();
        $('#btn_sinc_precio_costo').hide();
        $('#btn_sinc_oitb').hide();
        $('#btn_item-three').hide();
        $('#btn_business_partner').hide();
    });
    
    $(document).on('click','#btn_sinc_oitb',function(){
        $('#msn_item-group').removeClass('display-none');
        $('#btn_sinc_login').hide();
        $('#btn_sinc_producto').hide();
        $('#btn_sinc_precio_costo').hide();
        $('#btn_sinc_oitb').hide();
        $('#btn_item-three').hide();
        $('#btn_business_partner').hide();
    });

    $(document).on('click','#btn_item-three',function(){
        $('#msn_item-three').removeClass('display-none');
        $('#btn_sinc_login').hide();
        $('#btn_sinc_producto').hide();
        $('#btn_sinc_precio_costo').hide();
        $('#btn_sinc_oitb').hide();
        $('#btn_item-three').hide();
        $('#btn_business_partner').hide();
    });

    $(document).on('click','#btn_business_partner',function(){
        $('#msn_business_partner').removeClass('display-none');
        $('#btn_sinc_login').hide();
        $('#btn_sinc_producto').hide();
        $('#btn_sinc_precio_costo').hide();
        $('#btn_sinc_oitb').hide();
        $('#btn_item-three').hide();
        $('#btn_business_partner').hide();
    });
});