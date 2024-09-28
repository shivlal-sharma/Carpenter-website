<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AdminNotAuth;
use App\Http\Middleware\UserAuth;
use App\Http\Middleware\UserNotAuth;

Route::view('privacy-policy','user.privacy&policy')->name('privacy&policy');

Route::view('','user.home')->name('home');

Route::view('about','user.about')->name('about');

Route::view('service','user.service')->name('service');

Route::view('service/wardrobes','user.designs.wardrobe')->name('wardrobe');

Route::view('service/beds','user.designs.bed')->name('bed');

Route::view('service/halls','user.designs.hall')->name('hall');

Route::view('service/kitchens','user.designs.kitchen')->name('kitchen');

Route::view('service/dinings','user.designs.dining')->name('dining');

Route::view('service/ceilings','user.designs.ceiling')->name('ceiling');

Route::view('service/walls','user.designs.wall')->name('wall');

Route::middleware(UserNotAuth::class)->group(function(){
    
    Route::view('register','user.register')->name('register');

    Route::view('login','user.login')->name('login');

    Route::view('forget-password','user.forget_pass')->name('forget_password');
});

Route::view('contact','user.contact')->name('contact')->middleware(UserAuth::class);

Route::controller(UserController::class)->middleware(UserNotAuth::class)->group(function(){

    Route::post('contact','contactStore')->name('contactStore')->withoutMiddleware(UserNotAuth::class)->middleware(UserAuth::class);

    Route::post('register','registerStore')->name('registerStore');

    Route::get('verify-email/{token}','verifyEmail')->name('verifyEmail');

    Route::post('login','loginStore')->name('loginStore');

    Route::post('forget-password','forgetPassword')->name('forget_Password');

    Route::get('reset-password/{token}','viewResetPassPage')->name('reset_password');

    Route::post('reset-password','resetPassword')->name('resetPassword');

    Route::get('logout','logout')->name('logout')->withoutMiddleware(UserNotAuth::class)->middleware(UserAuth::class);

});


// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Route::view('admin/sign_in','admin.sign_in')->name('admin_sign_in')->middleware(AdminNotAuth::class);

Route::view('admin/forget-password','admin.forgetPassword')->name('forgetPassword')->middleware(AdminNotAuth::class);

Route::view('admin/user-add','admin.addUser')->name('userAdd')->middleware(AdminAuth::class);

Route::view('admin/contact-add','admin.addContact')->name('contactAdd')->middleware(AdminAuth::class);

Route::view('admin/admin-add','admin.addAdmin')->name('adminAdd')->middleware(AdminAuth::class);

Route::prefix('admin')->controller(AdminController::class)->middleware(AdminAuth::class)->group(function(){

    Route::get('dashboard','dashboard')->name('dashboard');

    Route::post('sign_in','adminLogin')->name('adminLogin')->withoutMiddleware(AdminAuth::class)->middleware(AdminNotAuth::class);

    Route::post('forget-password','forgetPassword')->name('adminForgetPassword')->withoutMiddleware(AdminAuth::class)->middleware(AdminNotAuth::class);

    Route::get('reset-password/{token}','viewResetPassPage')->name('resetPassword')->withoutMiddleware(AdminAuth::class)->middleware(AdminNotAuth::class);

    Route::post('reset-password','resetPassword')->name('adminResetPassword')->withoutMiddleware(AdminAuth::class)->middleware(AdminNotAuth::class);

    Route::get('sign_out','adminLogout')->name('adminLogout');

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

// --------------------------------------------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Route::get('admin-info','admins')->name('admin-info');

    Route::post('admin-add','adminAdd')->name('adminAdd');

    Route::get('admin-info/{id}','adminTrash')->name('adminTrash');

    Route::get('admin-edit/{id}','adminEditPage')->name('adminEditPage');

    Route::post('admin-edit/{id}','adminEdit')->name('adminEdit');

    Route::get('admin-trash-view','adminTrashView')->name('adminTrashView');

    Route::get('admin-force-delete/{id}','adminForceDelete')->name('adminForceDelete');

    Route::get('admin-restore/{id}','adminRestore')->name('adminRestore');

});
