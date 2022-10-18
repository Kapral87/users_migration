<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\VkUser;
use App\Http\Resources\VkUser as VkUserResource;

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
const ERROR_MESSAGE_NOT_FOUND = 'Resource not found';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/users', function () {
    return VkUserResource::collection(VkUser::all());
});

Route::get('v1/users/{id}', function($id) {
    $user = VkUser::find($id);
    if (!$user) {
        return response()->json([
            'error' => ERROR_MESSAGE_NOT_FOUND
        ], 404);
    }
    return new VkUserResource(VkUser::find($id));
});
