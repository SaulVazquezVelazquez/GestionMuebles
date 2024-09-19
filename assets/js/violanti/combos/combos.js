$.post(baseurl + "Combos/Ccombos/getTipoReporte",{
},
function (data){
    var tipo_reporte = JSON.parse(data);
    $.each(tipo_reporte,function(i,item){
        $('#tipo_reporte').append('<option value="' + item.id_tipo_reporte + '">' + item.concepto + '</option>');
    });
});

$('#tipo_reporte').change(function(){
	$('#tipo_reporte option:selected').each(function(){
		var id = $('#tipo_reporte').val();
		//atrapar el id y pasarlo como parametro al combo
		$.post(baseurl + "Combos/Ccombos/getAlmacenes",
			{
				"id_tipo_reporte" : id
			},
			function(data){
                var almacen = JSON.parse(data);
                $('#almacen').html('<option selected disabled value="nulo">Selecciona una opción</option>');
				$.each(almacen,function(i,item){
					$('#almacen').append('<option value="'+item.id_almacen+'">'+item.almacen+'</option>');
				});
			});
	});
});

$('#almacen').change(function(){
	$('#almacen option:selected').each(function(){
		var id = $('#almacen').val();
		//atrapar el id y pasarlo como parametro al combo
		$.post(baseurl + "Combos/Ccombos/getPlantas",
			{
				"id_almacen" : id
			},
			function(data){
                var id_planta = JSON.parse(data);
				$.each(id_planta,function(i,item){
                    $('#id_planta').val(item.id_plantas);
				});
			});
	});
});

$.post(baseurl + "Combos/Ccombos/getClientes",{
},
function (data){
    var clientes = JSON.parse(data);
    $.each(clientes,function(i,item){
        $('#clientes').append('<option value="' + item.id_business_partnes + '">' + item.card_foreign_name + '</option>');
    });
});

$.post(baseurl + "Combos/Ccombos/getTipoCotizacion",{
},
function (data){
    var tipo_cotizacion = JSON.parse(data);
    $.each(tipo_cotizacion,function(i,item){
        $('#tipo_cotizacion').append('<option value="' + item.id_tipo_cotizacion + '">' + item.concepto + '</option>');
    });
});