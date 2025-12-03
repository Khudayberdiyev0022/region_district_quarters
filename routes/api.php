<?php

use App\Http\Controllers\Api\V1\DistrictController;
use App\Http\Controllers\Api\V1\QuarterController;
use App\Http\Controllers\Api\V1\RegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//  return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
  Route::get('/regions', [RegionController::class, 'index']);
  Route::get('/regions/{id}', [RegionController::class, 'show']);
  Route::get('/districts', [DistrictController::class, 'index']);
  Route::get('/districts/{id}', [DistrictController::class, 'show']);
  Route::get('/quarters', [QuarterController::class, 'index']);
  Route::get('/quarters/{id}', [QuarterController::class, 'show']);
});
