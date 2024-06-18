<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Mahasiswa
    Route::delete('mahasiswas/destroy', 'MahasiswaController@massDestroy')->name('mahasiswas.massDestroy');
    Route::post('mahasiswas/media', 'MahasiswaController@storeMedia')->name('mahasiswas.storeMedia');
    Route::post('mahasiswas/ckmedia', 'MahasiswaController@storeCKEditorImages')->name('mahasiswas.storeCKEditorImages');
    Route::resource('mahasiswas', 'MahasiswaController');

    // fakultas
    Route::delete('fakultas/destroy', 'FakultasController@massDestroy')->name('fakultas.massDestroy');
    Route::resource('fakultas', 'FakultasController');

    // Mahasiswa
    Route::delete('jurusans/destroy', 'JurusanController@massDestroy')->name('jurusans.massDestroy');
    Route::resource('jurusans', 'JurusanController');
    
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
