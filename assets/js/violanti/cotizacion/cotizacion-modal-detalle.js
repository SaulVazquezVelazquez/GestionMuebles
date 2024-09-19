$(document).ready(function() {
    // Evento cuando se muestra el modal
    $('.btn-abrir-modal').on('click', function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del enlace
        
        // Obtener el ID del detalle de cotización del modal desde data-target
        var modalId = $(this).attr('data-target');
        var idDetalleCotizacion = modalId.replace('#detalle', ''); // Obtener solo el ID del detalle
        
        // Obtener los datos filtrados por código SAP del elemento correspondiente
        var datosFiltrados = $('#datosFiltrados' + idDetalleCotizacion).html();
        
        // Mostrar los datos filtrados en el cuerpo del modal
        $(modalId + ' .modal-body .tabla-resultado' + idDetalleCotizacion).html(datosFiltrados);
        
        // Mostrar el modal
        $(modalId).modal('show');
    });
});
