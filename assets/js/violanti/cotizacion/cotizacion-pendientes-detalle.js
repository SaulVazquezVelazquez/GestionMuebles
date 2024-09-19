$(document).ready(function () {

	$('#selectAllItems').change(function() {
        var isChecked = $(this).prop('checked');
        $('input[name="items[]').prop('checked', isChecked);
    });

	$(document).on('click', '#btn_detalle_factor', function () {

		$('#detalle_factores').toggleClass('display-none');
	});


	$('#cancelarItems').on('click', function () {
		var selectedItems = [];
		// Recorre todos los checkboxes seleccionados y agrega sus valores al array
		$('input[name="items[]"]:checked').each(function () {
			selectedItems.push($(this).val());
		});
		
		// Verifica si se ha seleccionado al menos un ítem
		if (selectedItems.length === 0) {
			// Si no se ha seleccionado ningún ítem, muestra una alerta
			alert("Debes seleccionar al menos un ítem para cancelar.");
			return; // Detiene la ejecución de la función
		}

		// Establece el valor del campo oculto con el array de ítems seleccionados
		$('#itemsSeleccionados').val(JSON.stringify(selectedItems));
		$('#accion').val(0);
		// Envía el formulario
		$('#accionConjunta').submit();
	});

	$('#aprobarItems').on('click', function () {
		var selectedItems = [];
		// Recorre todos los checkboxes seleccionados y agrega sus valores al array
		$('input[name="items[]"]:checked').each(function () {
			selectedItems.push($(this).val());
		});

		// Verifica si se ha seleccionado al menos un ítem
		if (selectedItems.length === 0) {
			// Si no se ha seleccionado ningún ítem, muestra una alerta
			alert("Debes seleccionar al menos un ítem para cancelar.");
			return; // Detiene la ejecución de la función
		}

		// Establece el valor del campo oculto con el array de ítems seleccionados
		$('#itemsSeleccionados').val(JSON.stringify(selectedItems));
		$('#accion').val(1);
		// Envía el formulario
		$('#accionConjunta').submit();
	});

	$('#cambiarMargen').on('click', function () {
		var selectedItems = [];
		// Recorre todos los checkboxes seleccionados y agrega sus valores al array
		$('input[name="items[]"]:checked').each(function () {
			selectedItems.push($(this).val());
		});

		// Verifica si se ha seleccionado al menos un ítem
		if (selectedItems.length === 0) {
			// Si no se ha seleccionado ningún ítem, muestra una alerta
			alert("Debes seleccionar al menos un ítem para cambiar el margen.");
			return; // Detiene la ejecución de la función
		}

		// Pide al usuario que ingrese el nuevo margen
		var nuevoMargen = prompt("Ingresa el nuevo margen:", "");
		var descripcion = prompt("Observaciones:", "");
		// Verifica si el usuario ingresó un valor
		if (nuevoMargen === null || nuevoMargen === "") {
			// Si el usuario cancela o no ingresa nada, detiene la ejecución
			return;
		}

		// Valida que el nuevo margen sea un número
		if (isNaN(nuevoMargen)) {
			alert("El valor ingresado no es válido. Por favor, ingresa un número válido.");
			return; // Detiene la ejecución de la función
		}

		// Establece el valor del campo oculto con el array de ítems seleccionados
		$('#itemsSeleccionadosMargen').val(JSON.stringify(selectedItems));
		// Establece el valor del nuevo margen en otro campo oculto
		$('#nuevoMargen').val(nuevoMargen);
		$('#nuevaDescripcion').val(descripcion);
		// Envía el formulario
		$('#accionConjuntaMargen').submit();
	});

    $('#autorizarCotizacion').click(function () {
        var selectedItems = [];
        $('input[name="estatusArray[]"]').each(function () {
            selectedItems.push($(this).val());
        });
    
        if (selectedItems.length === 0) {
            // Si no se ha seleccionado ningún ítem, muestra una alerta
            alert("Debes autorizar o cancelar items para aprobar cotizacion.");
            return; // Detiene la ejecución de la función
        }
    
        var itemsSinAutorizar = false;
    
        // Iterar sobre los valores de estatus
        selectedItems.forEach(function (estatus) {
            // Validar si algún valor es 3 (falta autorización)
            if (estatus === "3") {
                itemsSinAutorizar = true;
            }
        });
    
        // Si hay items sin autorizar, mostrar un mensaje
        if (itemsSinAutorizar) {
            alert("Falta autorizar algunos items. Por favor, asegúrate de autorizar todos los items antes de continuar.");
        } else {
            // Verificar si todos los items tienen valor 0 o 1
            var todosAutorizados = selectedItems.every(function (estatus) {
                return estatus === "0" || estatus === "1";
            });
    
            if (todosAutorizados) {
                $('#autorizandoCotizacion').submit();
            } else {
                alert("Algunos items tienen valores no válidos. Por favor, asegúrate de que todos los items tengan un valor de 0 o 1.");
            }
        }
    });
});