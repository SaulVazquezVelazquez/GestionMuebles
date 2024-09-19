<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Clogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/** Login */
$route['inicio-sesion'] = 'Clogin/inicioSesion';
$route['cerrar-sesion'] = 'Clogin/cerrarSesion';

/** Dashboard */
$route['dashboard-disenio-ingenieria']   = 'Usuarios/CdireccionDisenioIngenieria';
$route['dashboard-direccion-general']    = 'Usuarios/CdireccionGeneral';
$route['dashboard-direccion-comercial']  = 'Usuarios/CdireccionComercial';
$route['dashboard-direccion-contable']   = 'Usuarios/CdireccionContable';
$route['dashboard-servicio-cliente']     = 'Usuarios/CservicioCliente';
$route['dashboard-direccion-planta']     = 'Usuarios/CdireccionPlanta';
$route['dashboard-direccion-desarrollo'] = 'Usuarios/CsuperUsuario';
$route['dashboard-disenio']              = 'Usuarios/Cdisenio';

/** APIS */
$route['login-sap']                   = 'Apis/Sap/Clogin';
$route['sap-item-get-registros']      = 'Apis/Sap/Citems/getRegistros';
$route['sap-item-get-precio-costo']   = 'Apis/Sap/Citems/getPrecioCosto';
$route['sap-item-oitb-get-registros'] = 'Apis/Sap/Coitb/getRegistros';
$route['sap-item-ittm-get-registros'] = 'Apis/Sap/Cittm1/getRegistros';
$route['sap-clientes']                = 'Apis/Sap/CbusinessPartners/getRegistros';

/** SUPER USUARIO */
$route['dashboard-super-usuario'] = 'Reportes/CreporteInventario';

/** ALMACEN REPORTE */
$route['reporte-inventario']         = 'Reportes/CreporteInventario';
$route['generar-reporte-inventario'] = 'Reportes/CreporteInventario/generarReporte';
$route['excel-reporte-inventario']   = 'Reportes/CreporteInventario/exportExcel';

/** SUPER USUARIO - CONFIGURACION API */
$route['sincronizar-apis'] = 'Apis/Sincronizar/Csincronizar';

/** DISEÑO E INGENIERIA - COTIZADOR */
$route['cotizador'] = 'Cotizador/Ccotizador';
$route['cotizacion-items'] = 'Cotizador/Ccotizador/cotizacionItems';
$route['cotizacion-items-detalles'] = 'Cotizador/Ccotizador/cotizacionItemsDetalle';
$route['previo-items-detalles'] = 'Cotizador/Ccotizador/previoCotizacionDetalle';
$route['agregar-variante/(:any)/(:any)/(:any)'] = 'Cotizador/Ccotizador/agregarVariante';
$route['detalle-cotizacion/(:any)/(:any)'] = 'Cotizador/Ccotizador/detalleOrder';
$route['detalle-item/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Cotizador/Ccotizador/detalleItem';
$route['eliminar-item'] = 'Cotizador/Ccotizador/eliminarItem';
$route['editar-item/(:any)/(:any)/(:any)'] = 'Cotizador/Ccotizador/editarItemCot';
$route['enviar-cotizacion/(:any)/(:any)'] = 'Cotizador/Ccotizador/enviarCotizacion';

/** Cotizaciones pendientes */
$route['cotizaciones'] = 'Cotizaciones/Ccotizaciones';
$route['cotizaciones-pendientes'] = 'Cotizaciones/Pendientes/CcotizacionesPendientes';
$route['cotizaciones-pendientes-detalle/(:num)/(:num)'] = 'Cotizaciones/Pendientes/CcotizacionesPendientes/detalle';
$route['cotizaciones-pendientes-detalle-item/(:any)/(:num)/(:num)'] = 'Cotizaciones/Pendientes/CcotizacionesPendientes/detalleItem';
$route['accion-conjunta-item-detalle'] = 'Cotizaciones/Pendientes/CcotizacionesPendientes/accionesConjunta';
$route['cambio-marjen-conjunta-item-detalle'] = 'Cotizaciones/Pendientes/CcotizacionesPendientes/actualizarMargenObservacionConjunta';

/** Cotizaciones Pendientes Direccion General */
$route['cotizaciones-pendientes-revisar'] = 'Cotizaciones/Pendientes/CcotizacionesPendientes';
$route['actualizar-margen-observacion'] = 'Cotizaciones/Pendientes/CcotizacionesPendientes/actualizarMargenObservacion';
$route['aprobar-cancelar-item'] = 'Cotizaciones/Pendientes/CcotizacionesPendientes/actualizarItemAC';
$route['exportar-excel-cotizaciones-pendientes'] = 'Cotizaciones/Pendientes/CcotizacionesPendientes/exportarExcel';

/** Cotizaciones Aprobadas */
$route['aprobar-cotizacion'] = 'Cotizaciones/Aprobadas/CcotizacionesAprobadas/aprobar';
$route['cotizaciones-aprobadas'] = 'Cotizaciones/Aprobadas/CcotizacionesAprobadas';
$route['cotizaciones-aprobada-detalle/(:num)/(:num)'] = 'Cotizaciones/Aprobadas/CcotizacionesAprobadas/detalle';
$route['cotizaciones-aprobadas-detalle-item/(:any)/(:num)/(:num)'] = 'Cotizaciones/Aprobadas/CcotizacionesAprobadas/detalleItem';

/** Validaciones Aprobadas */
$route['validaciones-aprobadas'] = 'Validaciones/Aprobadas/CvalidacionesAprobadas';

/** PDF */
$route['pdf-formato-formal-cotizacion'] = 'Cotizaciones/Aprobadas/CcotizacionesAprobadas/genera_formato_formal_cotizacion_pdf';
$route['pdf-formato-word'] = 'Cotizaciones/Aprobadas/CcotizacionesAprobadas/genera_formato_word_pdf';
$route['pdf-formato-validacion'] = 'Cotizaciones/Aprobadas/CcotizacionesAprobadas/genera_formato_validacion_pdf';

/** CLAVES */
$route['claves'] = 'Claves/Cclaves';
$route['claves/actualizar'] = 'Claves/Cclaves/actualizar';
$route['claves/registro'] = 'Claves/Cclaves/registrar';

/**AUTORIZACION */
$route['autorizacion-cotizacion'] = 'Cotizaciones/Autorizacion/Ccautorizacion/autorizar';