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

Route::get('/', function () {
    return view('welcome');
});

Route::any('view/{module?}/{parent?}/{php?}', function ($module = '', $parent = '', $php = '') {
    $view = trim($module . '.' . $parent . '.' . $php, '.');
    $viewPath = base_path('resources/views/' . str_replace('.', '/', $view));

    if(is_dir($viewPath)) {
        $view .= '.index';
    }

    return view($view, ['user' => request()->all()]);
});

Route::group([
    'prefix' => 'bupt',
    'namespace' => 'Bupt'
], function () {
    Route::controllers([
        'user' => 'UserController'
    ]);
    Route::group([
        'middleware' => 'user.login'
    ], function () {
        Route::controllers([
        ]);
    });
});