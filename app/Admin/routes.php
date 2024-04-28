<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('healthinspectors', healthinspectorController::class);
    $router->resource('expectantmothers', expectantmothersController::class);
    $router->resource('tuberculoses', tuberculosisController::class);
    $router->resource('aids', aidsController::class);
    $router->resource('kideraas', kideraaController::class);
    $router->resource('kiderabs', kiderabController::class);
    $router->resource('katetes', kateteController::class);
    $router->resource('reportedcases', reportedcasesController::class);
    $router->resource('sessions', sessionsController::class);
    $router->resource('supervisors', SupervisorsController::class);
    $router->resource('trainings', TrainingsController::class);
    $router->resource('mobilizations', MobilizationsControler::class);
});
