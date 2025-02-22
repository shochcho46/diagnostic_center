<?php

use Illuminate\Support\Facades\Route;
use Modules\Organization\Http\Controllers\OrganizationController;

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

Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
    Route::controller(OrganizationController::class)->group(function () {
        Route::get('organization/index', 'index')->name('admin.organizationIndex');
        Route::get('organization/create', 'create')->name('admin.organizationCreate');
        Route::post('organization/store', 'store')->name('admin.organizationStore');
        // Route::get('organization/{organization}/edit', 'roleEdit')->name('admin.roleEdit');
        // Route::put('organization/{organization}/update', 'roleUpdate')->name('admin.roleUpdate');
        // Route::delete('organization/{organization}/delete', 'roleDestroy')->name('admin.roleDestroy');
        // Route::get('organization/{organization}/with/permission', 'roleWithPermission')->name('admin.roleWithPermission');
        // Route::put('organization/{organization}/with/permission/assign', 'roleWithPermissionStore')->name('admin.roleWithPermissionStore');


    });
});

});
