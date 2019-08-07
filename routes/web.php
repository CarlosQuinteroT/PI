<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/dashboard', 'DashboardController');
    //Notificaciones 
    Route::post('/notification/get', 'NotificationController@get'); 
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Almacenero']], function () {
        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        Route::get('/categoria/listarPdf','CategoriaController@listarPdf')->name('categorias_pdf');
      
//       RUTAS DE ACADEMIAS QUE SIRVEN PARA REALIZAR EL CRUD 
        Route::get('/academia', 'AcademiaController@index'); //MUESTRA EL REGISTRO DE ACADEMIAS 
        Route::get('/academia/selectAcademia', 'AcademiaController@selectAcademia');
        Route::post('/academia/registrar', 'AcademiaController@store');
        Route::put('/academia/actualizar', 'AcademiaController@update');
        Route::put('/academia/desactivar', 'AcademiaController@desactivar');
        Route::put('/academia/activar', 'AcademiaController@activar');
        Route::get('/academia/contadorAcademia', 'AcademiaController@contadorAcademia');
        
      
        Route::get('/actividad', 'ActividadController@index');
        Route::post('/actividad/registrar', 'ActividadController@store');
        Route::put('/actividad/actualizar', 'ActividadController@update');
        Route::put('/actividad/desactivar', 'ActividadController@desactivar');
        Route::put('/actividad/activar', 'ActividadController@activar');
      
        Route::get('/persona', 'PersonaController@index');
        Route::post('/persona/registrar', 'PersonaController@store');
        Route::put('/persona/actualizar', 'PersonaController@update');
        Route::put('/persona/desactivar', 'PersonaController@desactivar');
        Route::put('/persona/activar', 'PersonaController@activar');
        Route::get('/persona/selectPersonas', 'PersonaController@selectPersonas');
        Route::get('/persona/contadorPersona', 'PersonaController@contadorPersona');
        Route::put('/persona/selectInfoPersona', 'PersonaController@selectInfoPersona');
      
        Route::get('/instructor/selectInstructor', 'InstructorController@selectInstructor');
        Route::put('/instructor/selectInfoInstructor', 'InstructorController@selectInfoInstructor');
       
        Route::put('/academiainstructor/selectInfoAcademiaInstructor', 'AcademiaInstructorController@selectInfoAcademiaInstructor');
        Route::post('/academiainstructor/registrar', 'AcademiaInstructorController@store');
        Route::put('/academiainstructor/desactivar', 'AcademiaInstructorController@desactivar');
        Route::put('/academiainstructor/activar', 'AcademiaInstructorController@activar');  
      
        Route::get('/curso', 'CursoController@index');
        Route::post('/curso/registrar', 'CursoController@store');
        Route::put('/curso/actualizar', 'CursoController@update');
        Route::put('/curso/desactivar', 'CursoController@desactivar');
        Route::put('/curso/activar', 'CursoController@activar');
        Route::get('/curso/contadorCurso', 'CursoController@contadorCurso');
      
        Route::get('/califCurso', 'CursoInstructorController@index');
      
        Route::post('/cursoacademia/registrar', 'CursoAcademiaController@store');
        Route::put('/cursoacademia/selectInfoCursoAcademia', 'CursoAcademiaController@selectInfoCursoAcademia');
        Route::put('/cursosacademias/getIdCursoAcademia', 'CursoAcademiaController@getIdCursoAcademia');
      
      
        Route::post('/cursosinstructores/registrarCursoInstructor', 'CursoInstructorController@store');
      Route::put('/cursosinstructores/selectInfoCursoInstructor', 'CursoInstructorController@selectInfoCursoInstructor');
      
      
        Route::get('/contacto', 'ContactoController@index');
        Route::post('/contacto/registrar', 'ContactoController@store');
        Route::put('/contacto/actualizar', 'ContactoController@update');
        Route::put('/contacto/desactivar', 'ContactoController@desactivar');
        Route::put('/contacto/activar', 'ContactoController@activar');
        Route::get('/contacto/selectContacto', 'ContactoController@selectContacto');
        Route::put('/contacto/selectInfoContacto', 'ContactoController@selectInfoContacto');
        Route::get('/contacto/contadorContactos', 'ContactoController@contadorContactos');
      
        Route::get('/ticket', 'TicketController@index');
        Route::post('/ticket/registrar', 'TicketController@store');
        Route::put('/ticket/actualizar', 'TicketController@update');
        Route::put('/ticket/desactivar', 'TicketController@desactivar');
        Route::put('/ticket/activar', 'TicketController@activar');
      
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');

        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');
        Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo');
        Route::get('/articulo/listarPdf','ArticuloController@listarPdf')->name('articulos_pdf');

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        Route::get('/proveedor/listarPdf','ProveedorController@listarPdf')->name('proveedores_pdf');

        Route::get('/ingreso', 'IngresoController@index');
        Route::post('/ingreso/registrar', 'IngresoController@store');
        Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        Route::get('/ingreso/obtenerCabecera', 'IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles');
        Route::get('/ingreso/pdf/{id}','IngresoController@pdf')->name('ingreso_pdf');
        Route::get('/ingreso/listarPdf','IngresoController@listarPdf')->name('ingresos_pdf');
    });

    Route::group(['middleware' => ['Vendedor']], function () {
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');
        Route::get('/cliente/listarPdf','ClienteController@listarPdf')->name('clientes_pdf');
 
        Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');

        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
        Route::get('/venta/pdf/{id}','VentaController@pdf')->name('venta_pdf');
        Route::get('/venta/pdfTicket/{id}','VentaController@pdfTicket')->name('ventaticket_pdf');
        Route::get('/venta/listarPdf','VentaController@listarPdf')->name('ventas_pdf');
    });

    Route::group(['middleware' => ['Administrador']], function () {
        
        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        Route::get('/categoria/listarPdf','CategoriaController@listarPdf')->name('categorias_pdf');

        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');
        Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo');
        Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');
        Route::get('/articulo/listarPdf','ArticuloController@listarPdf')->name('articulos_pdf');

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        Route::get('/proveedor/listarPdf','ProveedorController@listarPdf')->name('proveedores_pdf');

        Route::get('/ingreso', 'IngresoController@index');
        Route::post('/ingreso/registrar', 'IngresoController@store');
        Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        Route::get('/ingreso/obtenerCabecera', 'IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles');
        Route::get('/ingreso/pdf/{id}','IngresoController@pdf')->name('ingreso_pdf');
        Route::get('/ingreso/listarPdf','IngresoController@listarPdf')->name('ingresos_pdf');
        
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');
        Route::get('/cliente/listarPdf','ClienteController@listarPdf')->name('clientes_pdf');

        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
        Route::get('/venta/pdf/{id}','VentaController@pdf')->name('venta_pdf');
        Route::get('/venta/pdfTicket/{id}','VentaController@pdfTicket')->name('ventaticket_pdf');
        Route::get('/venta/listarPdf','VentaController@listarPdf')->name('ventas_pdf');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        Route::get('/user/listarPdf','UserController@listarPdf')->name('usuarios_pdf');
    });

});

//Route::get('/home', 'HomeController@index')->name('home');
