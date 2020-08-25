<?php

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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\EstatesController;
use App\Http\Controllers\SingleEstateController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\CheckIfAdmin;

Route::get('/', function () {
    return view('welcome')->with('active' , 13);
})->name('index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::resource('adminPanel/estates' , 'EstatesController')->middleware(['auth','checkIfAdmin']);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/adminPanel' , [AdminController::class,'index'])->name('panel.index')->middleware(['auth','checkIfAdmin']);
Route::Resource('/adminPanel/users' , 'UsersController')->middleware(['auth','checkIfAdmin']);
Route::get('/adminPanel/settings',[SiteSettingsController::class,'index'])->middleware(['auth','checkIfAdmin'])->name('setting.index');
Route::post('/adminPanel/settings',[SiteSettingsController::class,'store'])->middleware(['auth','checkIfAdmin'])->name('setting.store');
Route::resource('/home/getEstates','SingleEstateController');
Route::get('/forRent','SingleEstateController@forRent');
Route::get('/forBuy','SingleEstateController@forBuy');
Route::get('/type/{type}','SingleEstateController@showByType');
Route::get('/search' ,  [SingleEstateController::class,'search'])->name('single.search');
Route::get('estates/show/{estate}',[SingleEstateController::class,'show'])->name('single.show');
Route::get('/contact-us' ,[ContactUsController::class , 'index'])->name('contact-us.index');
Route::post('/contact-us/store' ,[ContactUsController::class , 'store'])->name('contact-us.store');
Route::resource('/adminPanel/contact' , 'ContactController')->middleware(['auth' , 'checkIfAdmin']);
Route::PUT('/adminPanel/contact/{contact}' , 'ContactController@read')->name('contact.read')->middleware(['auth','checkIfAdmin']);
Route::get('add-estate' , 'EstatesController@userAdd')->name('user.add');
Route::POST('add-estate' , 'EstatesController@userStore')->name('user.store');
Route::get('MyEstates/nonActive' , [EstatesController::class,'getMyNonActiveEstates1'])->name('showNonActive')->middleware(['auth']);
Route::get('MyEstates/active' , [EstatesController::class,'getMyActiveEstates'])->name('showMyEstateActive')->middleware(['auth']);
Route::get('user/edit' , [EstatesController::class,'editMyData1'])->name('editData')->middleware(['auth']);
Route::PUT('user/edit' , [EstatesController::class,'updateData'])->name('updateUser')->middleware(['auth']);
Route::post('user/edit' , [EstatesController::class,'updatePass'])->name('updatePass')->middleware(['auth']);
Route::get('user/editEstate/{estate}' , [EstatesController::class,'editEstate'])->name('EditEstate')->middleware(['auth']);
Route::PUT('user/editEstate/{estate}' , [EstatesController::class,'updateEstate'])->name('user.estate.update')->middleware(['auth']);
Route::get('adminPanel/estates/user/{user}' , [EstatesController::class,'ShowEstateForUser'])->name('estates.user')->middleware(['auth','checkIfAdmin']);
Route::get('/adminPanel/estates/user//{estate}/status',[EstatesController::class,'changeStatus'])->name('change.status')->middleware(['auth' ,'checkIfAdmin']);
Route::get('/adminPanel/estates/nonActive/show' ,[EstatesController::class,'getNonActive'])->name('admin.estates.non')->middleware(['auth','checkIfAdmin']);
Route::get('/adminPanel/estates/allActive/show' , [EstatesController::class , 'showAllActive'])->name('showAllActive')->middleware(['auth','checkIfAdmin']);
Route::get('/adminPanel/estates/allNonActive/show' , [EstatesController::class , 'showAllNonActive'])->name('showAllNonActive')->middleware(['auth','checkIfAdmin']);
Route::get('/x/d',[EstatesController::class,'showAllNonActive']);

