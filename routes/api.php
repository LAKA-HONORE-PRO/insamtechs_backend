<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\VideothequeController;
use App\Http\Controllers\Api\FormationController;
use App\Http\Controllers\Api\BibliothequeController;
use App\Http\Controllers\Api\FasciculeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//PAGE D'ACCUEIL
    Route::get('/config_home',[ConfigController::class,'index']);
//FIN PAGE D'ACCUEIL



//VIDEOTHEQUE

Route::get('/videotheque',[VideothequeController::class,'index']);
Route::get('/videotheque/{slug}',[VideothequeController::class,'show']);


//FIN VIDEOTHEQUE


//FORMATION

Route::get('/formations',[FormationController::class,'index']);
Route::get('/formation/{catSlug}',[FormationController::class,'getByCategorie']);

//FIN FORMATION



//BIBLIOTHEQUE
Route::get('/bibliotheque',[BibliothequeController::class,'index']);
Route::get('/livres_by_category/{slug}', [BibliothequeController::class, 'getByCategorie']);

//FIN BIBLIOTHEQUE




//FASCICULES

Route::get('/filieres',[FasciculeController::class,'filieres']);
Route::get('/filiere/{slug}',[FasciculeController::class,'filiere']);
Route::get('/series_filiere/{slug}',[FasciculeController::class,'getSeriesByFiliere']);


//FIN FASCICULES


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/