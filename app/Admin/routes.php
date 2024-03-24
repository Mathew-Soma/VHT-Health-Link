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
    $router->resource('vhtmembers', vhtmembersController::class);
    $router->resource('villages', VillagesController::class);
    //$router->resource('disease_-cases', Disease_CasesController::class);
    $router->resource('health-inspectors', HealthInspectorController::class);
    //$router->resource('sessions', SessionsController::class);
    $router->resource('patients', PatientsController::class);
    $router->resource('trainings', TrainingController::class);
    $router->resource('health-centers', HealthCentersController::class);
    $router->resource('reminders', RemindersController::class);
    //$router->resource('ussdsessions', ussdsessions::class);
    $router->resource('sessions', sessionsController::class);
    $router->resource('reported-cases', ReportedCasesController::class);

    //Rubongi village routes
    $router->resource('kidera-as', KideraAController::class);
    $router->resource('kidera-bs', KideraBController::class);
    $router->resource('kamukuzis', KamukuziController::class);
    $router->resource('katetes', KateteController::class);

    //Patients routes
    $router->resource('aidspatients', aidspatientsController::class);
    $router->resource('expectantmothers', expectantmothersController::class);
    $router->resource('tuberculoses', TuberculosisController::class);

    //hospital routes
    $router->resource('boma-hospitals', BomaHospitalsController::class);
    $router->resource('katete-hospitals', KateteHospitalsController::class);
    $router->resource('kiswahili-hospitals', KiswahiliHospitalsController::class);

});
