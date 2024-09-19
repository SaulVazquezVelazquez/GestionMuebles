$(document).ready(function (){

    $('#mns_procesando').addClass('card-body display-none');
    $(document).on('click','#procesar_orden',function(){
        $('#mns_procesando').removeClass('display-none');
        $('#mns_detalle').addClass('card-body display-none');
        $('#mns_titulo').addClass('card-body display-none');
        $('#procesar_orden').hide();
        
    });
});