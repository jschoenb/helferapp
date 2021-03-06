<?php

use App\ShoppingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/* auth */
Route::group(['middleware' => ['api', 'cors']], function () {
    Route::post('auth/login', 'Auth\ApiAuthController@login');
});

// methods which need authenticatoion - JWT Token
Route::group(['middleware' => ['api', 'cors', 'auth.jwt']], function(){
    Route::post('auth/logout', 'Auth\ApiAuthController@logout');

});


Route::get('shoppinglist/{id}', function ($id) {
    try {
        return App\Shoppinglist::getListById($id);
    } catch (Error $e) {
        return $e->getMessage();
    }
});

Route::post('shoppinglist', function ($id) {
    try {
        return App\ShoppingList::createList();
    } catch (Error $e) {
        return $e->getMessage();
    }
});

Route::put('shoppinglist/{id}', function ($id) {
    try {
        return App\ShoppingList::updateList($id);
    } catch (Error $e) {
        return $e->getMessage();
    }
});
