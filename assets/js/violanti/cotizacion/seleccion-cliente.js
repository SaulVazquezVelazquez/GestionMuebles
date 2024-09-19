$(document).change(function(){
    let esError = 0;
    let cliente = $("#clientes").val();
    let tipo_cot = $("#tipo_cotizacion").val();
    
   
    if (cliente == 'null' || cliente === null){
		esError++;
	}
    if (tipo_cot == 'null' || tipo_cot === null ){
		esError++;
	}

    if(esError < 1){
        $('#btn_continuar').removeClass('disabled');
        $('#btn_continuar').show();
       
    }else{
        $('#btn_continuar').removeClass('btn btn-primary');
        $('#btn_continuar').addClass('btn btn-primary disabled');
    }
});