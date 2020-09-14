<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');
Route::get('/details/pengajuan/{id}', 'DetailController@pengajuan')->name('pengajuan');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

Route::get('/success', 'CartController@success')->name('success');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');



Route::group(['middleware' => ['auth']], function() {

  Route::get('/cart', 'CartController@index')->name('cart');
  Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

  Route::get('/pengajuan', 'PengajuanController@index')->name('pengajuans');
  Route::get('/pengajuan/{id}', 'PengajuanController@detail')->name('pengajuans-detail');

  Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-product');
    Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-product-create');
    Route::post('/dashboard/product', 'DashboardProductController@store')->name('dashboard-product-sispras');
    Route::get('/dashboard/products/{id}', 'DashboardProductController@details')->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/proposals', 'DashboardProposalController@index')->name('dashboard-proposal');
    Route::get('/dashboard/proposals/create', 'DashboardProposalController@create')->name('dashboard-proposal-create');
    Route::post('/dashboard/proposal', 'DashboardProposalController@store')->name('dashboard-proposal-sispras');
    Route::get('/dashboard/proposal/edit/{id}', 'DashboardProposalController@edit')->name('dashboard-proposal-edit');
    Route::post('/dashboard/proposal/{id}', 'DashboardProposalController@update')->name('dashboard-proposal-updates');
    Route::delete('/dashboard/proposal/{id}', 'DashboardProposalController@delete')->name('dashboard-proposal-delete');
    Route::get('/dashboard/proposal/detail/{id}', 'DashboardProposalController@detail')->name('dashboard-proposal-detail');


    Route::post('/dashboard/proposals/gallery/upload', 'DashboardProposalController@uploadGallery')->name('dashboard-proposal-gallery-upload');
    Route::get('/dashboard/proposals/gallery/delete/{id}', 'DashboardProposalController@deleteGallery')->name('dashboard-proposal-gallery-delete');  



    Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', 'DashboardSettingController@sispras')->name('dashboard-settings-sispras');
    Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-settings-redirect');
  
});

Route::prefix('admin')
  ->namespace('Admin')
  ->middleware(['auth', 'admin'])
  ->group(function() {
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('product', 'ProductController');
    Route::resource('product-gallery', 'ProductGalleryController');
    Route::resource('proposal', 'ProposalController');
    Route::resource('proposal-gallery', 'ProposalGalleryController');
    Route::get('proposal/detail/{id}', 'ProposalDetailController@detail')->name('dashboard-proposal-details');
    Route::post('proposal/detail/{id}', 'ProposalDetailController@update')->name('dashboard-proposal-update');
  });


Auth::routes();

