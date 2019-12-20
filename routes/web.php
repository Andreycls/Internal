<?php
Route::get('/', function () { return redirect('/beranda'); });
// beranda
Route::get('get', 'UploadController@index');
Route::post('uploadss', 'UploadController@upload');

Route::get('/getstates/{id}','CSPendaftaranController@getStates');

Route::resource('pengumuman', 'CSPengumumanController');
Route::resource('pendaftaran', 'CSPendaftaranController');
$this->get('pengumuman/{id}','CSPengumumanController@show');
$this->get('beranda', 'ClientSideController@index');

$this->get('pengumuman','ClientSideController@showAll');
//Route::resource('pengumuman', 'ClientSideController');
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...    
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('xxx', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('xxx', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/beranda', function () {
        return view('Admin/home.home');
    });
    Route::get('/getstates/{id}','PendaftaranController@getStates');
    Route::resource('beranda','Admin\HomeController');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('expense_categories', 'Admin\ExpenseCategoriesController');
    Route::post('expense_categories_mass_destroy', ['uses' => 'Admin\ExpenseCategoriesController@massDestroy', 'as' => 'expense_categories.mass_destroy']);
    Route::resource('income_categories', 'Admin\IncomeCategoriesController');
    Route::post('income_categories_mass_destroy', ['uses' => 'Admin\IncomeCategoriesController@massDestroy', 'as' => 'income_categories.mass_destroy']);
    Route::resource('incomes', 'Admin\IncomesController');
    Route::post('incomes_mass_destroy', ['uses' => 'Admin\IncomesController@massDestroy', 'as' => 'incomes.mass_destroy']);
    Route::resource('expenses', 'Admin\ExpensesController');
    Route::post('expenses_mass_destroy', ['uses' => 'Admin\ExpensesController@massDestroy', 'as' => 'expenses.mass_destroy']);
    Route::resource('monthly_reports', 'Admin\MonthlyReportsController');
    Route::resource('currencies', 'Admin\CurrenciesController');
    Route::post('currencies_mass_destroy', ['uses' => 'Admin\CurrenciesController@massDestroy', 'as' => 'currencies.mass_destroy']);
    Route::post('currencies_restore/{id}', ['uses' => 'Admin\CurrenciesController@restore', 'as' => 'currencies.restore']);
    Route::delete('currencies_perma_del/{id}', ['uses' => 'Admin\CurrenciesController@perma_del', 'as' => 'currencies.perma_del']);
    Route::resource('pengumuman', 'Admin\PengumumanController');
    Route::post('pengumuman_mass_destroy', ['uses' => 'Admin\PengumumanController@massDestroy', 'as' => 'pengumuman.mass_destroy']);
    Route::resource('panduan','Admin\PanduanController');
    Route::resource('gedung','Admin\GedungController');
    Route::resource('ruangan','Admin\RuanganController');
    Route::resource('kota','Admin\KotaController');
    Route::resource('pendaftaran','Admin\PendaftaranController');
    // singgung ke online
    Route::get('pendaftar/list_pendaftar_online','Admin\PendaftaranController@indexOnline');
    Route::get('pendaftar/list_pendaftar_offline','Admin\PendaftaranController@index');
    Route::resource('generate','Admin\GenerateController');
    
    Route::get("addmore","GedungController@addMore");
    Route::post("addmore","Gedung@addMorePost");

    Route::resource('jadwal','Admin\JadwalController');
    
    Route::get('image/upload','PengumumanController@fileCreate');
    Route::post('image/upload/store','PengumumanController@store');
    //Route::post('image/delete','PengumumanController@fileDestroy');

    //Generate PDF
    Route::get('generate/pdf/daftar_hadir', 'Admin\GenerateController@generateAll_DaftarHadir');

    Route::get('generate/pdf/stiker_meja', 'Admin\GenerateController@generateAll_StikerMeja');
});
