<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('index2', 'Home::index2');

//controlador::metodo
$routes->get('listadoxclientes', 'Clientes::listado_cliente');
$routes->get('clientes', 'Clientes::index');
$routes->get('clientelista', 'Clientes::cliente_lista');
$routes->get('conexion', 'Clientes::indexu');
$routes->get('login2', 'UsuariosTitania::consulta_cliente');


$routes->get('login', 'Autentificacion::login');
$routes->get('inicio', 'Autentificacion::inicio');
$routes->get('consulta', 'Autentificacion::consulta');
$routes->get('salir', 'Autentificacion::salir');
$routes->post('menu', 'Autentificacion::ingresar');

/*Centro Poblado */
$routes->get('centro', 'Autentificacion::centroPoblado');
$routes->post('buscarPorId', 'Autentificacion::BuscarPorId');
$routes->post('insertarData', 'Autentificacion::InsertarData');


/*vias*/ 
$routes->get('vias', 'viasController\ViasControlador::Vias');
$routes->post('InsertarVia', 'viasController\ViasControlador::InsertarVia');
$routes->post('BuscarId', 'viasController\ViasControlador::BuscarId');

/*Aranceles */
$routes->get('ListarCompleta', 'arancelController\ArancelControlador::ListarCenViasController');
$routes->get('ListarCompletaArancel', 'arancelController\ArancelControlador::ListarArancelNetoController');
$routes->post('BuscarIdArancel', 'arancelController\ArancelControlador::BuscarPorIdController');
$routes->post('BuscarIdCenVia', 'arancelController\ArancelControlador::ListarArancelController');
$routes->post('InsertarArancel', 'arancelController\ArancelControlador::InsertarNuevoArancelController');


/*Personas*/

$routes->get('personas','personasController\PersonasControlador::ListarPersonasController');
$routes->post('InsertarPersonas','personasController\PersonasControlador::GuardarRegistroController');
$routes->post('BuscarPersona','personasController\PersonasControlador::BuscarRegistroPersonaController');








