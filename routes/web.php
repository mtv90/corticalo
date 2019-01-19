<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

// Routes für die einzelnen Unterseiten
Route::get('/', 'PagesController@welcome');
Route::get('/impressum', 'PagesController@impressum');
Route::get('/datenschutz', 'PagesController@datenschutz');
Route::get('/anwender', 'PagesController@anwender');
Route::get('/funktionen', 'PagesController@funktionen');
Route::get('/kontakt', 'PagesController@kontakt');
Route::get('/about', 'PagesController@about');
Route::post('/kontakt', 'PagesController@storeKontakt');
///////////

// Routes für Userbereich
Route::get('/user/{id}', 'UserController@show');
/////////

// Routes für das User Dashboard
Route::get('/dashboard', 'DashboardController@index');
Route::get('/getcrfs/{id}', 'DashboardController@getcrfs');
Route::get('/getstudy/{id}', 'DashboardController@getstudy');
////////////////////////////

// Routes für den Studienbereich
Route::resource('studies', 'StudiesController');
Route::post('storeFrom', ['as' => 'studies.storeFrom', 'uses' => 'StudiesController@storeFrom']);
Route::post('store', ['as' => 'studies.store', 'uses' => 'StudiesController@store']);
Route::delete('/studies/{id}', 'StudiesController@destroy');
Route::get('/getdetails/{id}', 'StudiesController@showanswer');
Route::post('/studies/overview', 'StudiesController@showOverview');
Route::get('/studies/stats', 'StudiesController@statistics'); 
/////////////////////////////////////////////////////////////

// Routes für den CRF Bereich
Route::resource('crfs', 'CrfsController');
Route::get('/crfs/{id}/show', 'CrfsController@show');
Route::delete('/crfs/{id}', 'CrfsController@destroy');
Route::delete('/crfs/{id}/show', 'CrfsController@destroyAsync');
Route::post('storeFromDash', ['as' => 'crfs.storeFromDash', 'uses' => 'CrfsController@storeFromDash']);
/////////////////////////////////

// Routes für den FragenBereich
Route::delete('/forms/{id}', 'FormsController@destroyAsync');
Route::delete('/forms/{id}/show', 'FormsController@destroy');
Route::resource('forms', 'FormsController');
Route::get('/forms/{id}/show', 'FormsController@show');
Route::get('/getformats/{id}', 'FormsController@getformats');
Route::get('/geteditformats/{id}', 'FormsController@geteditformats');
Route::get('/getranges/{id}', 'FormsController@getranges');
Route::get('/getsavedranges/{id}', 'FormsController@getsavedranges');
Route::get('/getunits', 'FormsController@getunits');
Route::get('/getsavedunits/{id}', 'FormsController@getsavedunits');
Route::post('addForm', ['as' => 'forms.addForm', 'uses' => 'FormsController@addForm']);
Route::post('storeForms', ['as' => 'forms.storeForms', 'uses' => 'FormsController@storeForms']);
///////////////////////////////////////////

// Routes für Auswahlbereich
// Route::resource('choices', 'ChoicesController');
Route::get('/choices', 'ChoicesController@index');
Route::post('/choices', 'ChoicesController@store');
Route::get('/choices/create', 'ChoicesController@create');
Route::delete('/choices/{id}', 'ChoicesController@destroy');
Route::get('/choices/{id}', 'ChoicesController@show');
Route::put('/choices/{id}', 'ChoicesController@update');
Route::get('/choices/{id}/edit', 'ChoicesController@edit');
Route::get('/getform/{id}', 'ChoicesController@getform');
Route::post('storeChoice', ['as' => 'choices.storeChoice', 'uses' => 'ChoicesController@storeChoice']);
//////////////////////////////////////////////////////////////////////

// Routes für den Antwortbereich
Route::resource('answers', 'ResultsController');
Route::delete('/answers/{id}/confirm', ['as' => 'answers.destroy', 'uses' => 'ResultsController@destroy']);
Route::post('/answers/{id}/confirm', 'ResultsController@confirmDelete');
///////////////////////////////////////////////////////

// Routes für CRUD-Funktionalität Patienten
Route::resource('patients', 'PatientsController');
/////////////////////////////////////////////

// Routes für Benutzerrechtebereich
Route::resource('roles', 'RolesController');
Route::resource('rights', 'RightsController');
/////////////////////////////////////////////////////













Route::delete('/answers/{id}', 'ResultsController@destroy');

Auth::routes();



