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

Route::get('/', function () {
    return redirect()->to('/login');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Dashboard for registered users
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth' ], function () {
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');;
    Route::get('campaigns/', 'DashboardController@campaigns')->name('campaign');
    Route::get('campaigns/{id}', 'DashboardController@campaign_detail')->where('id', '.+')->name('campaign-details');
    Route::get('campaigns-edit/{id}', 'DashboardController@campaign_edit')->where('id', '.+')->name('campaign-edit');
    Route::get('calendar/', 'DashboardController@calendar')->name('calendar');
    Route::get('balance/', 'DashboardController@balance')->name('balance');
    Route::get('charge/', 'DashboardController@charge')->name('charge');
    Route::get('account/', 'DashboardController@account')->name('account');
    Route::get('add-campaign/', 'DashboardController@add_campaign')->name('add-campaign');
    Route::get('traffic/{id}', 'DashboardController@campaign_traffic')->name('campaigns_traffic');

    /* Forms */
    Route::post('add-campaign-form/', 'DashboardController@add_campaign_process')->name('add-campaign-process');
    Route::post('campaigns-filter/', 'DashboardController@campaigns_filter')->name('campaigns-filter');
    Route::post('account-edit/', 'DashboardController@account_edit')->name('account-edit');
    Route::post('campaigns-disable/', 'DashboardController@campaigns_disable')->name('campaigns_disable');

    /* Filters & paginations */
    Route::post('stats-filter', 'DashboardController@filter_stats_list')->name('dashboard-filter-stats');
    Route::post('ajax-filter/', 'DashboardController@ajax_filter')->name('ajax-filter');

});

// Admin pages
Route::group(['prefix' => 'admin', 'middleware' => 'auth' ], function () {
    Route::get('/', 'AdminController@dashboard_page')->name('admin-dashboard');
    Route::get('users', 'AdminController@users_page')->name('admin-users');
    Route::get('products', 'AdminController@products_page')->name('admin-products');
    Route::get('balance', 'AdminController@balance_page')->name('admin-balance');
    Route::get('cpc-rates', 'AdminController@cpc_page')->name('admin-cpc');
    Route::get('feed', 'AdminController@feed_page')->name('admin-feed');
    Route::get('add-product', 'AdminController@addproduct_page')->name('add-product');
    Route::get('products/{id}/edit/', 'AdminController@editproduct_page')->name('edit-product');
    Route::get('subproduct/{id}/edit/', 'AdminController@editsubproduct_page')->name('edit-subproduct');
    Route::get('users/{id}', 'AdminController@user_page')->where('id', '.+')->name('users');
    Route::get('campaigns/{id}', 'AdminController@campaigns_page')->where('id', '.+')->name('campaigns');
    Route::get('products/{id}', 'AdminController@product_subproducts')->name('product-subproducts');
    Route::get('products-list/', 'AdminController@products_list_page')->name('products-list');
    /* Edit pages */
    Route::get('edit/', 'AdminController@edit_pages')->name('edit_pages');
    Route::get('edit/faq', 'AdminController@edit_pages_faq')->name('edit_pages_faq');
    Route::get('edit/sitemap', 'AdminController@edit_pages_sitemap')->name('edit_pages_sitemap');
    Route::get('edit/security', 'AdminController@edit_pages_security')->name('edit_pages_security');
    Route::get('edit/terms', 'AdminController@edit_pages_terms')->name('edit_pages_terms');
    Route::get('edit/contact', 'AdminController@edit_pages_contact')->name('edit_pages_contact');
    Route::get('edit/registration', 'AdminController@edit_pages_registration')->name('edit_pages_registration');
    Route::get('edit/campaign', 'AdminController@edit_pages_campaign')->name('edit_pages_campaign');
    Route::get('edit/product', 'AdminController@edit_pages_product')->name('edit_pages_product');
    /* Admin's forms */
    Route::post('add-product', 'AdminController@product_add')->name('add-product-form');
    /* Ajax */
    Route::post('account-edit', 'AdminController@users_type')->name('admin-users-ajax-type');
    Route::post('account-accept', 'AdminController@user_request_accept')->name('admin-users-request-accept');
    Route::post('account-decline', 'AdminController@user_request_decline')->name('admin-users-request-decline');
    Route::post('stats-filter', 'AdminController@filter_stats_list')->name('filter-stats');
    Route::post('admin-ajax', 'AdminController@ajax_requests')->name('admin-ajax');
    Route::post('admin-ajax-filter', 'AdminController@ajax_filters')->name('admin-ajax-filter');
    /* Pagination */
    Route::post('users/campaigns-pagination', 'AdminController@user_page_campaigns_pagination')->name('admin-users-campaigns-pagination');
    /* Filters */
    Route::post('products/filter', 'AdminController@filter_products')->name('filter-products');
    Route::post('products/{id}/filter', 'AdminController@filter_subproducts')->name('filter-subproducts');
    Route::post('users/users-filter', 'AdminController@filter_users_list')->name('filter_users_list');

    /* Edit pages */
    Route::post('edit/faq/request', 'AdminController@edit_faq_ajax')->name('edit_faq_ajax');
});

// Pages footer
Route::get('/sitemap', 'PagesController@sitemap_page')->name('sitemap');
Route::get('/terms-of-service', 'PagesController@terms_page')->name('terms-of-service');
Route::get('/security-page', 'PagesController@security_page')->name('security_page');
Route::get('/faq', 'PagesController@faq_page')->name('faq');
Route::get('/contact', 'PagesController@contact_page')->name('contact');
Route::get('/about', 'PagesController@about')->name('about');

// Forms
Route::post('faq/search', 'PagesController@faq_search')->name('faq_search');