$("#multiple").on('change', function() {
    let esError = 0;
    var clave = $(this).val();
    // te muestra un array de todos los seleccionados
    console.log(clave);

    if (clave.length === 0){
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