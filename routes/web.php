<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'HomeController@list')->name('home');

/*Route::get('/events', function () {
    return view('pages.events');
});*/

// Events
Route::get('/event/create', 'EventController@createEventForm')->name('create.event');
Route::post('/event/create', 'EventController@createEvent')->name('create.event');
Route::get('/event/{id}/edit', 'EventController@editEventForm')->where(['id' => '[0-9]+'])->name('edit.event');
Route::post('/event/{id}/edit', 'EventController@editEvent')->where(['id' => '[0-9]+'])->name('edit.event');
Route::get('/event/{id}/delete', 'EventController@deleteEvent')->where(['id' => '[0-9]+'])->name('delete.event');
Route::get('/events', 'EventController@list')->name('events'); //TODO: mudar nome de funcao?? ou de controller??
Route::get('/event/{id}', 'EventController@show')->where(['id' => '[0-9]+'])->name('event');
Route::get('/tags/{id}/events', 'TagController@show')->where(['id' => '[0-9]+'])->name('tags.events');
Route::get('/categories/events', 'CategoryController@showEventCategories')->name('categories.events');
Route::get('/organicunits/{id}/events', 'OrganicUnitController@show')->where(['id' => '[0-9]+'])->name('organics.events');
Route::get('/events/seach', 'EventController@search')->name('search.events');

// SERVICES

Route::get('/services','ServiceController@list')->name('services');
//Route::get('/service/{id}','ServiceController@createServiceForm')->name('create.service');
Route::get('/service/{id}', 'ServiceController@show')->where(['id' => '[0-9]+'])->name('show.service');
Route::get('/service/{id}/create', 'ServiceController@createServiceForm')->where(['id' => '[0-9]+'])->name('create.service');
Route::post('/create.service', 'ServiceController@createService')->name('create.service.form');
Route::get('/delete.service/{id}', 'ServiceController@deleteService')->where(['id' => '[0-9]+'])->name('delete.service');
Route::get('/show.service/{id}', 'ServiceController@showServiceForm')->where(['id' => '[0-9]+'])->name('show.service');
Route::get('/edit.service/{id}', 'ServiceController@editServiceForm')->where(['id' => '[0-9]+'])->name('edit.service');
Route::post('/edit.service/{id}', 'ServiceController@editService')->where(['id' => '[0-9]+'])->name('edit.service');
Route::post('/new.service', 'ServiceController@createNewService')->name('new.service');



//SEARCH
Route::get("/admin/gis", 'UserControllerAdmin@showSearch');
Route::post('/admin/gis', 'UserController@search')->name('users.search');


// Admin
///Events
/*
Route::get('/admin', function () {
    Route::get('/', 'EventController@show')->name('home');
});*/
Route::get("/admin", 'AdminController@show');
Route::get('/admin/events', 'EventControllerAdmin@show');
Route::get('/admin/eventsCurrent', 'EventControllerAdmin@showCurrent');
Route::get('/admin/eventsPending', 'EventControllerAdmin@showPending');
Route::post('/requests/events/{id}/{action}', 'EventControllerAdmin@updateStatus')->where(['id' => '[0-9]+', 'action' => '(Accepted|Rejected)'])->name('requests.status.update');
Route::get("/admin/user/{id}/assign/gi", 'UserControllerAdmin@assignGI')->where(['id' => '[0-9]+'])->name('users.assignRole');

//TODO: adicionar permission checks as routes por baixo



Route::get('/admin/user/switch/start','AdminController@user_switch_start');
Route::get('/admin/user/switch/stop','AdminController@user_switch_stop');



//Route::get("/admin/services", 'ServiceControllerAdmin@show');
Route::get('/admin/servicesCurrent', 'ServiceControllerAdmin@showCurrent');
Route::get('/admin/servicesPending', 'ServiceControllerAdmin@showPending');
Route::post('/requests/services/{id}/{action}', 'ServiceControllerAdmin@updateStatus')->where(['id' => '[0-9]+', 'action' => '(Accepted|Rejected)'])->name('requests.services.status.update');

Route::get("/admin/services", function () {
    $organicunits = app('App\Http\Controllers\OrganicUnitController')->getOrganicUnits();
    $serviceNames = app('App\Http\Controllers\ServiceController')->getServiceNames();
    return view("pages.adminServices", ['organicunits' => $organicunits, 'serviceNames' => $serviceNames]);
});
Route::get("/admin/gis", function () {
    $organicunits = app('App\Http\Controllers\OrganicUnitController')->getOrganicUnits();
    return view('pages.adminGis', ['organicunits' => $organicunits]);
});

/* TODO: substituir as duas routes de cima por estas
Route::get('/admin/services', 'EventController@adminDashboardServices')->name('admin.services');
Route::get('/admin/gis', 'EventController@adminDashboardGis')->name('admin.gis');
*/


// Tags
Route::get('/create_tag', 'TagController@createTagForm')->name('create.tag');
Route::post('/create_tag', 'TagController@createTag')->name('create.tag');



// USER
Route::get('/my_requests', 'UserController@showRequests')->name('my.requests');



// Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// RSS
Route::feeds();

//Static pages
Route::get("/about", function () {
    return view("pages.about");
});
Route::get("/faq", function () {
    return view("pages.faq");
});
Route::get("/contacts", function () {
    return view("pages.contact");
});
