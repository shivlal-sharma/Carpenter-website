<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('home');
// });

Route::view('user/footer','user.footer')->name('footer');

Route::view('user/register','user.register')->name('register');

Route::view('user/login','user.login')->name('login');

Route::view('user/service/wardrobes','user.designs.wardrobe')->name('wardrobe');

Route::view('user/service/beds','user.designs.bed')->name('bed');

Route::view('user/service/halls','user.designs.hall')->name('hall');

Route::view('user/service/kitchens','user.designs.kitchen')->name('kitchen');

Route::view('user/service/dinings','user.designs.dining')->name('dining');

Route::view('user/service/ceilings','user.designs.ceiling')->name('ceiling');

Route::view('user/service/walls','user.designs.wall')->name('wall');

Route::prefix('user')->controller(UserController::class)->group(function(){

    Route::get('','home')->name('home');

    Route::get('about','about')->name('about');

    Route::get('service','service')->name('service');

    Route::get('contact','contact')->name('contact');

    Route::post('contact','contactStore')->name('contactStore');

    Route::post('register','registerStore')->name('registerStore');

    Route::post('login','loginStore')->name('loginStore');

    Route::get('logout','logout')->name('logout');

});


// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Route::view('admin/user-add','admin.addUser')->name('userAdd');

Route::view('admin/contact-add','admin.addContact')->name('contactAdd');

Route::prefix('admin')->controller(AdminController::class)->group(function(){

    Route::get('dashboard','dashboard')->name('dashboard');

    Route::get('user-info','users')->name('user-info');

    Route::post('user-add','userAdd')->name('userAdd');

    Route::get('user-info/{id}','userTrash')->name('userTrash');

    Route::get('user-edit/{id}','userEditPage')->name('userEditPage');

    Route::post('user-edit/{id}','userEdit')->name('userEdit');

    Route::get('user-trash-view','userTrashView')->name('userTrashView');

    Route::get('user-force-delete/{id}','userForceDelete')->name('userForceDelete');

    Route::get('user-restore/{id}','userRestore')->name('userRestore');

// --------------------------------------------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Route::get('contact-info','contacts')->name('contact-info');

    Route::post('contact-add','contactAdd')->name('contactAdd');

    Route::get('contact-info/{id}','contactTrash')->name('contactTrash');

    Route::get('contact-edit/{id}','contactEditPage')->name('contactEditPage');

    Route::post('contact-edit/{id}','contactEdit')->name('contactEdit');

    Route::get('contact-trash-view','contactTrashView')->name('contactTrashView');

    Route::get('contact-force-delete/{id}','contactForceDelete')->name('contactForceDelete');

    Route::get('contact-restore/{id}','contactRestore')->name('contactRestore');

});
