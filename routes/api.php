<?php


use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/test', function (Request $request) {
    return $request->user();
});
//Public
Route::get('/locations', [ApiController::class,'locations']);
Route::get('/categories', [ApiController::class,'categories']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/offersP/findlocation/{location}', [ApiController::class,'findlocation']);
Route::get('/offersP/categories/{categories}', [ApiController::class,'index']);
Route::get('/offersP/search/{products}', [ApiController::class,'search']);


//Protected
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::get('/offers/findlocation/{location}', [ApiController::class,'findlocation']);
    Route::get('/offers/categories/{categories}', [ApiController::class,'index']);
    Route::get('/offers/search/{products}', [ApiController::class,'search']);
    Route::post('/logout',[AuthController::class,'logout']);
    //Route::post('/offers',[ApiController::class,'store']);
    //Route::put('/offers/{id}', [ApiController::class,'update']);
    //Route::delete('/offers/{id}', [ApiController::class,'destroy']);
});
