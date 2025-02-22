<?php

use App\Http\Controllers\Api\GeoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::controller(GeoController::class)->group(function () {
        Route::get('all/division', 'loadAllDivision')->name('allDivision');
        Route::get('all/district', 'loadAllDistrict')->name('allDistrict');
        Route::get('all/upazila', 'loadAllUpazila')->name('allUpazila');
        Route::get('all/union', 'loadAllUnion')->name('allUnion');
    });
});
