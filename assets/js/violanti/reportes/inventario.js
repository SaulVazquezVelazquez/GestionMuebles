$(document).ready(function (){
    $('#mensaje_reporte').addClass('col-md-4 mb-3 display-none');
});
$(document).change(function(){
    let esError = 0;
    let tipo_reporte = $("#tipo_reporte").val();
    let almacen = $("#almacen").val();
  
    if (tipo_reporte == 'nulo'){
		esError++;
	}
    if (almacen == 'nulo' || almacen === null ){
		esError++;
	}

    if(esError < 1){
        $('#btn_generar_reporte').removeClass('disabled');
        $('#btn_generar_reporte').show();
       
    }else{
        $('#btn_generar_reporte').removeClass('btn btn-primary');
        $('#btn_generar_reporte').addClass('btn btn-primary disabled');
    }
});

$(document).on('click','#btn_generar_reporte',function(){
    $('#mensaje_reporte').removeClass('col-md-4 mb-3 display-none');
    $('#btn_generar_reporte').hide();
});

