<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::get('/authtest', array('before' => 'auth.basic', function() // before we access the htllo.php page as user authentication
{
	return View::make('hello');
}));


// Route group for API versioning 
// applying the filters/authentication to a group of routes

Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
{
	// registering  a resourceful route to the controller
	Route::resource('url', 'UrlController');

});




Route::group(array('prefix' => 'dbreport/api', 'before' => 'auth.basic'), function(){

//		Route::post('/insert', 'DbreportController@store');
//		Route::get('search', 'DbreportController@show');
		
		
		Route::resource('v1/', 'DbreportController', array('only' => array('store','index'))); // use the store method of the DbController to insert the data
		
});


















