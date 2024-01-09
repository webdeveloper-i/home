<?php

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

use App\Http\Controllers\Crm\EmailVerificationController;

Route::get('_healthcheck', function () {
    return 'OK';
});

Route::get('_phpinfo', function () {
    return phpinfo();
});



Route::group(['prefix' => 'user'],function (){

});

Route::group(['prefix'=>'frontend','namespace'=>'Frontend'],function(){
    Route::get('news', 'NewsController@index');
    Route::get('news/{id}', 'NewsController@show');
});
//authorized routes users
Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
    Route::post('login', 'Auth\AuthController@login');
//    Route::post('forgot-password', 'Auth\AuthController@forgotPassword');
    Route::post('change-password', 'Auth\AuthController@changePassword');
    Route::post('register', 'Auth\AuthController@register');
    Route::post('recovery', 'Auth\AuthController@recover');
    Route::get('verify/{verify_code}', 'Auth\AuthController@verifyEmail');
});

//authorized routes crm
Route::group(['prefix' => 'crm', 'middleware' => ['guest'], 'namespace' => 'Crm'], function () {
    Route::post('auth/login', 'AuthController@login');
});

Route::group(['prefix' => 'crm', 'namespace' => 'Crm'], function () {
    Route::get('i18n/lists', 'I18nController@lists');
    Route::get('languages', 'LanguageController@index');

    Route::get('news/lists', 'NewsController@lists');

    Route::put('news/status-update/{id}','NewsController@update_status');

    Route::get('config', 'ConfigController@index');
});


Route::group(['prefix' => 'crm', 'namespace' => 'Crm', 'middleware' => ['auth:api']], function () {
    //language module
    Route::apiResource('i18n', 'I18nController');
});

Route::group(['prefix' => 'crm', 'namespace' => 'Crm', 'middleware' => ['auth.jwt:admin']], function () {
    Route::get('auth/logout', 'AuthController@logout');
    Route::get('auth/refresh', 'AuthController@refresh');
});

Route::group(['prefix' => 'crm', 'namespace' => 'Crm', 'middleware' => ['auth.jwt:admin']], function () {

    //News moduli
    Route::apiResource('news', 'NewsController');

    ///profile
    Route::get('profile', 'ProfileController@view');
    Route::post('profile/change-password', 'ProfileController@changePassword');
    Route::post('profile/photo', 'ProfileController@photo');

    //config module

    Route::post('config', 'ConfigController@store');
    Route::put('config/{id}', 'ConfigController@update');
    Route::get('config/{id}', 'ConfigController@show');

    //role permission module

    Route::get('permission-groups/lists', 'PermissionGroupController@lists');
    Route::apiResource('permission-groups', 'PermissionGroupController');

    Route::get('backup-database', 'BackupController@index');
    Route::post('backup-store', 'BackupController@store');
    Route::delete('backup-delete/{path}', 'BackupController@destroy');

    // users
    Route::put('users/update-role/{id}', 'UserController@updateRole');
    Route::get('users/lists', 'UserController@lists');
    Route::apiResource('users', 'UserController');

});

Route::group(['prefix' => 'auth', 'middleware' => ['auth.jwt:user']], function () {

    Route::get('logout', 'Auth\AuthController@logout');
    Route::get('refresh', 'Auth\AuthController@refresh');

    Route::get('get-permission-groups/{id}', 'Common\ProfileController@getPermissionGroup');
    Route::get('profile/show', 'Common\ProfileController@show');
    Route::post('profile/update-profile', 'Common\ProfileController@updateProfile');
    Route::post('profile/change-password', 'Common\ProfileController@changePassword');
    Route::post('profile/photo', 'Common\ProfileController@photo');

});

//resources uchun route
Route::group(['prefix' => 'resources', 'middleware' => ['guest']], function () {
    // File save start  ---
    //Image uploads
    Route::post('storeImage', 'Resources\FileController@storeImage');
    //Test file upload
    Route::post('storeTest', 'Resources\FileController@storeTestFile');
    //File uploads
    Route::post('storeFile', 'Resources\FileController@storeFile');
    //Image uploads
    Route::post('storeImageEditor', 'Resources\FileController@storeImageEditor');
    //File uploads
    Route::post('storeFileEditor', 'Resources\FileController@storeFileEditor');
    //-----
    //File download
    Route::get('download/{uuid}', 'Resources\FileController@download');
    //original file url
    Route::get('mediaUrl/{uuid}', 'Resources\FileController@mediaUrl');
    Route::get('FileUrl/{uuid}', 'Resources\FileController@FileUrl');
    //Show images with request: width and height
    Route::get('showImage/{uuid}', 'Resources\FileController@showImage');
    //Move folder images with resize images
    Route::get('moveFolderImage/{uuid}', 'Resources\FileController@moveFolderImage');
    Route::get('moveFolderFile/{uuid}', 'Resources\FileController@moveFolderFile');
});
