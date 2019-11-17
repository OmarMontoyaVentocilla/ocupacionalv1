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

Route::get('/', function () {
	//return view('welcome.index');
	return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/listar', 'AutorController@listar');
Route::get('/listaridio', 'IdiomaController@listar');
Route::get('/listaredi', 'EditorialController@listar');
Route::get('/listaroles', 'RoleController@listar');
Route::get('/listauser','UserController@listar');
Route::get('/listardiagnostico','DiagnosticoController@listar');
Route::get('/listarespecialidad','SpecialityController@listar');
Route::get('/export','ExcelController@index');
Route::get('/listarequipo','EquipController@listar');
Route::get('/listarall','AssignRoleController@listar');
Route::get('/listarprovincia','CompanyController@listar');
Route::get('/listardistrito','CompanyController@listardis');
Route::get('/getdata','CompanyController@listardata');
Route::get('/listarroles','AssignRoleController@listrole');
Route::get('/listarroles','AssignRoleController@listrole');
Route::get('/listarpermisos', 'PermissionController@listar');
Route::get('/listarobra', 'ObraController@listar');
Route::get('/listararea', 'AreaController@listar');
Route::get('/listarprofile', 'ProfileController@listar'); 
Route::get('/listarexamen','ExamController@listar');
Route::get('/listardetexamen','DetailExamController@listar');
Route::get('/listaralldetexamen','DetailExamController@listardetalle');
Route::get('/listarcatalogos','CatalogoEmpresaController@listar');
Route::get('/detallecatalogo','CatalogoEmpresaController@catalogosdet');
Route::get('/listarprotocols','ProtocoloController@listar');
Route::get('/listarprofiles','ProtocoloController@listarprofiles');
Route::get('/listarprotcls','ProtocoloController@listarprotocols');
Route::get('/contarprotcolos','ProtocoloController@contarprotocols');
Route::get('/listarpacientes','PacientController@listar');
Route::get('/listadata','AtencionController@listar');
Route::get('/listprotempresa','AtencionController@listardata');
Route::get('/listatent','AtencionController@atencion');
Route::get('/listarordenes','AtencionOcupacionalController@listar');
Route::get('/lisareasocupacionale','AtencionOcupacionalController@consulta');
Route::get('/lisatenciones','AtencionOcupacionalController@atencion');
Route::get('/getdoctor','DoctorController@listar');
Route::get('/gettriajedat','TriajeController@listar');
Route::get('/getdatostriaj','TriajeController@datos');
Route::get('/getdermadat','DermatologiaController@listar');
Route::get('/getdatosderma','DermatologiaController@datos');
Route::get('/getantecededat','AntecedentesController@listar');
Route::get('/getdatosantecede','AntecedentesController@datos');
Route::get('/gethistoriaocudat','HistoriaOcupacionalController@listar');
Route::get('/getdatosocupacional','HistoriaOcupacionalController@datos');

// Route::get('/comboesp','SpecialityController@especialiCombo');
// Route::get('/comboequipo','EquipController@tospeciality');
//-----------------------------------------------------------//

Route::resource('autor', 'AutorController');
Route::resource('editorial', 'EditorialController');
Route::resource('idioma', 'IdiomaController');
Route::resource('categoria', 'CategoryController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('users','UserController');
Route::resource('diagnostics','DiagnosticoController');
Route::resource('especialidad','SpecialityController');
Route::resource('equipo','EquipController');
Route::resource('empresa','CompanyController');
Route::resource('asignar-roles','AssignRoleController');
Route::resource('obra','ObraController');
Route::resource('area','AreaController');
Route::resource('profile','ProfileController');
Route::resource('examen','ExamController');
Route::resource('detalle-examen','DetailExamController');
Route::resource('catalogo-empresa','CatalogoEmpresaController');
Route::resource('protocolo','ProtocoloController');
Route::resource('paciente','PacientController');
Route::resource('orden-atencion','AtencionController');
Route::resource('doctor','DoctorController');
Route::resource('atencion-ocupacional','AtencionOcupacionalController');
Route::resource('triaje','TriajeController');
Route::resource('dermatologia','DermatologiaController');
Route::resource('antecedentes','AntecedentesController');
Route::resource('historia','HistoriaOcupacionalController');