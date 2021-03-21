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

Auth::routes();

Route::group(['middleware'=>['auth:web']], function(){

	Route::group(['middleware'=>['is_user']], function(){
		Route::get('/phone/verification', 'VerificationTokenController@verify_page');
		Route::resource('verificationToken', 'VerificationTokenController')->only('store');
		Route::patch('/phone/verification/verify', 'VerificationTokenController@verify')->name('verificationToken.verify');
		Route::get('/profile', 'UserController@profile');
		Route::post('/update', 'UserController@update')->name('profile.update');
		Route::get('/', 'HomeController')->name('home');
		Route::get('/home', 'HomeController')->name('home');

		Route::group(['middleware'=>['is_complete']], function(){
			Route::resource('beneficiaries', 'BeneficiaryController');
			Route::resource('groups', 'GroupController');
			Route::resource('thrifts', 'ThriftController');
			Route::get('thrifts/add/{id}', 'ThriftController@create');
			Route::resource('payments', 'PaymentController');
		});
		Route::get('/notifications', function(){
			return view('notifications.index');
		});
		Route::get('/notifications/{id}', function($id){
			DB::table('notifications')->where('id', $id)->update(['read_at'=>\Carbon\Carbon::now()]);
			$notification = DB::table('notifications')->where('id', $id)->first();
			return view('notifications.show', ['id'=>$id, 'notification'=>$notification]);
		});
		Route::get('/notifications/all/clear', function(){
			auth()->user()->unreadNotifications()->update(['read_at' => now()]);
			return redirect()->back();
		});

	});

	Route::group(['middleware'=>['is_admin'], 'prefix'=>'admin'], function(){

		Route::group(['as'=>'admin.'], function(){
			Route::get('/home', 'AdminController')->name('home');
			Route::resource('beneficiaries', 'BeneficiaryController');
			Route::resource('groups', 'GroupController');
			Route::resource('volunteers', 'UserController');
			Route::resource('payments', 'PaymentController');
			Route::resource('thrifts', 'ThriftController');
			Route::get('/thrifts/approve/{id}', 'ThriftController@approve');
			Route::get('/thrifts/decline/{id}', 'ThriftController@decline');
			ROute::resource('administrators', 'AdminUserController');
			ROute::resource('roles', 'RoleController');
		});

		Route::get('/', 'AdminController');
		Route::get('/volunteer/approve/{id}', 'UserController@approveVolunteer');
		Route::get('/volunteer/perm/{id}', 'UserController@perm');
		Route::get('/pending_payments', 'BeneficiaryController@pendingPayments');
		Route::get('/beneficiary/pay/{id}', 'BeneficiaryController@payNow');
		Route::post('send_notification', 'UserController@notify')->name('notify_user');
		Route::get('/notifications', 'UserController@createNotif');
	});

});

Route::get('/confirm_bank', 'BeneficiaryController@confirmBank');


Route::get('/logout', function(\Request $request){
	$request->session()->invalidate();
    $request->session()->flush();
    $request->session()->regenerateToken();
});