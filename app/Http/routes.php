<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
	return view('welcome');

});

	

Route::get('algoritmos', function(){
	return view('home.algoritmos.algoritmos');
});


Route::group(['prefix' => 'algoritmo'], function(){
	
	Route::group(["prefix" => 'busqueda-ciega'], function(){
		
		Route::get('anchura', function(){
			return view('home.algoritmos.algoritmo.busquedaciega.anchura');
		});


		Route::get('profundidad', function(){
			return view('home.algoritmos.algoritmo.busquedaciega.profundidad');
		});
	});


	Route::group(["prefix" => 'busqueda-guiada'], function(){
		
		Route::get('ruta-corta', function(){
			return view('home.algoritmos.algoritmo.busquedaguiada.ruta_corta');
		});


		
	});
	
});


Route::group(['prefix' => 'animaciones'], function(){

	Route::get('anchura', [
		'uses' => 'grafoController@showAnchura',
		'as' => 'grafoAnimation'
	]);

	Route::get('profundidad', [
		'uses' => 'grafoController@showProfundidad',
		'as' => 'grafoAnimation'
	]);


	Route::get('ruta-corta/{id}',[
		'uses' => 'grafoController@showRuta',
		'as' => 'grafoAnimation'
	]);


	Route::group(['prefix' => 'grafo'], function(){

		Route::get('edit/{id}', [
			'uses' => 'grafoController@edit',
			'as' => 'grafoEdit'
		]);

		Route::post('store', [
			'uses' => 'grafoController@store',
			'as' => 'grafoStore'
		]);

		Route::get('create', [
			'uses' => 'grafoController@create',
			'as' => 'grafoCreate'
		]);

		Route::post('update/{id}', [
			'uses' => 'grafoController@update',
			'as' => 'grafoUpdate'
		]);

		Route::get('destroy/{id}', [
			'uses' => 'grafoController@destroy',
			'as' => 'grafoDestroy'
		]);

		Route::get('get-ruta/{id}', [
			'uses' => 'grafoController@getruta',
			'as' => 'grafoGetRuta'
		]);

		Route::group(['prefix' => 'edge'], function(){
			
			Route::get('destroy/{idg}/{id}', [
				'uses' => 'edgeController@destroy',
				'as' => 'edgeDestroy'
			]);

			Route::post('store', [
				'uses' => 'edgeController@store',
				'as' => 'edgeStore'
			]);
		});

		
	});

});

Route::group(['prefix' => 'sistema-experto'], function(){

	Route::get('index', [
		'uses' => 'sistemaexpertoController@index',
		'as' => 'sistemaIndex'
	]);

	Route::get('create', [
		'uses' => 'sistemaexpertoController@create',
		'as' => 'sistemaCreate'
	]);

	Route::post('store', [
		'uses' => 'sistemaexpertoController@store',
		'as' => 'sistemaStore'
	]);

	Route::get('show/{i}', [
		'uses' => 'sistemaexpertoController@show',
		'as' => 'sistemaShow'
	]);

	Route::get('edit/{i}', [
		'uses' => 'sistemaexpertoController@edit',
		'as' => 'sistemaEdit'
	]);

	Route::get('{id}/ask/{r?}', [
		'uses' => 'sistemaexpertoController@ask',
		'as' => 'sistemaAsk'
	]);

	Route::post('update/{i}', [
		'uses' => 'sistemaexpertoController@update',
		'as' => 'sistemaUpdate'
	]);

	Route::get('destroy/{i}', [
		'uses' => 'sistemaexpertoController@destroy',
		'as' => 'sistemaDestroy'
	]);

	Route::get('download/{i}', [
		'uses' => 'sistemaexpertoController@download',
		'as' => 'sistemaDownload'
	]);

	Route::get('upload', [
		'uses' => 'sistemaexpertoController@upload',
		'as' => 'sistemaUpload'
	]);

	Route::post('store-upload', [
		'uses' => 'sistemaexpertoController@storeupload',
		'as' => 'sistemaUStorepload'
	]);

});


	


Route::get('auth/login' , [
	'uses' => 'Auth\AuthController@getLogin',
	'as' => 'usuarioLogIn'
]);

Route::post('auth/login' , [
	'uses' => 'Auth\AuthController@postLogin',
	'as' => 'usuarioLogIn'
]);


Route::post('auth/register' , [
	'uses' => 'Auth\AuthController@postRegister',
	'as' => 'usuarioRegister'
]);

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegisterController@confirm'
]);


Route::get('home', [
	'uses' => 'registerController@bienvenido',
	'as' => 'UsuarioBienvenido'
]);


Route::get('password/reset/{token}', [
	'uses' => 'userController@resetPassword',
	'as' => 'resetPassword'
]);

Route::post('password/reset', [
	'uses' => 'App\AuthController@postReset',
	'as' => 'postReset'
]);

Route::get('password/forgot', [
	'uses' => 'userController@forgotPassword',
	'as' => 'forgotPassword'
]);

Route::post('password/sendmail', [
	'uses' => 'userController@sendMail',
	'as' => 'sendMail'
]);

Route::get('auth/confirm/email/{email}/confirm_token/{confirm_token}', 'Auth\AuthController@confirmRegister');







Route::auth();

