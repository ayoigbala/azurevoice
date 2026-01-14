<?php

use App\Installer\Controllers\InstallDatabaseController;
use App\Installer\Controllers\InstallFinishController;
use App\Installer\Controllers\InstallFolderController;
use App\Installer\Controllers\InstallIndexController;
use App\Installer\Controllers\InstallKeysController;
use App\Installer\Controllers\InstallMigrationsController;
use App\Installer\Controllers\InstallServerController;
use App\Installer\Controllers\InstallSetAdminAccountController;
use App\Installer\Controllers\InstallSetDatabaseController;
use App\Installer\Controllers\InstallSetKeysController;
use App\Installer\Controllers\InstallSetMigrationsController;
use App\Installer\Controllers\InstallAdminAccountController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'install',
    'as' => 'installer-router.',
    'namespace' => 'App\Installer\Controllers',
    'middleware' => ['web', 'installer']
], static function () {
    Route::get('/', ['as' => 'install.index', 'uses' => InstallIndexController::class]);
    Route::get('/server', ['as' => 'install.server', 'uses' => InstallServerController::class]);
    Route::get('/folders', ['as' => 'install.folders', 'uses' => InstallFolderController::class]);
    Route::get('/database', ['as' => 'install.database', 'uses' => InstallDatabaseController::class]);
    Route::post('/database', ['uses' => InstallSetDatabaseController::class]);
    Route::get('/migrations', ['as' => 'install.migrations', 'uses' => InstallMigrationsController::class]);
    Route::post('/migrations', ['uses' => InstallSetMigrationsController::class]);
    Route::get('/keys', ['as' => 'install.keys', 'uses' => InstallKeysController::class]);
    Route::post('/keys', ['uses' => InstallSetKeysController::class]);
    Route::get('/create-admin', ['as' => 'install.admin', 'uses' => InstallAdminAccountController::class]);
    Route::post('/create-admin', ['as' => 'install.set.admin', 'uses' => InstallSetAdminAccountController::class]);
    Route::get('/finish', ['as' => 'install.finish', 'uses' => InstallFinishController::class]);
});
