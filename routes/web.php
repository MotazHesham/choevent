<?php

Route::group(['as' => 'website.', 'namespace' => 'Website'], function () {
    Route::get('/artisan/{command}/{param?}','PagesController@doArtisanCommand');
    Route::get('/', 'PagesController@getHomePage')->name('home');
    Route::get('/lang/{locale}', 'PagesController@setLang')->name('language.set');
    Route::get('/about-us', 'PagesController@getAboutusPage')->name('aboutus');
    Route::get('/contact-us', 'PagesController@getContactusPage')->name('contactus');
    Route::get('/market', 'PagesController@getMarketPage')->name('market');
    Route::get('/conditions', 'PagesController@getConditionsPage');
    
    Route::get('/sponsors', 'SponsorsController@index')->name('sponsors.index');
   
    //news
    Route::get('/news', 'NewsController@index')->name('news.index');
    Route::get('/news/{id}', 'NewsController@show')->name('news.show');    
    //organizers
    Route::get('/organizers', 'OrganizersController@index')->name('organizers.index');
    Route::get('/organizers/{id}', 'OrganizersController@show')->name('organizers.show');
    // auth:register
    Route::get('/register', 'Auth\RegisterController@getRegisterPage')->name('register');
    Route::post('/register/validate', 'Auth\RegisterController@validateRegisterRequest')->name('register.validate');
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
    //verify mobile
    Route::get('/password/forget', 'Auth\VerifcationController@getForgetPasswordPage')->name('password.forget');
    Route::post('/password/forget', 'Auth\VerifcationController@sendPassword')->name('password.send');
    Route::get('/mobile/verify', 'Auth\VerifcationController@getVerifyMobilePage')->name('mobile.verify.page');
    Route::get('/mobile/verification/send', 'Auth\VerifcationController@sendverificationCode')->name('verification.send');
    Route::post('/mobile/verify', 'Auth\VerifcationController@verifyMobile')->name('mobile.verify');

    //user media
    Route::post('users/media', 'Auth\RegisterController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'Auth\RegisterController@storeCKEditorImages')->name('users.storeCKEditorImages');
    //auth :login
    Route::get('/log-in', 'Auth\LoginController@getLoginPage')->name('login');
    Route::post('/log-in', 'Auth\LoginController@login')->name('log-in');
    //profile
    Route::get('/profile', 'Auth\ProfileController@getProfilePage')->name('profile')->middleware('active');
    Route::put('/profile/update', 'Auth\ProfileController@updateProfile')->name('profile.update');
    //end auth
    Route::get('/providers', 'ProvidersController@index')->name('providers.index');
    //events
    Route::get('/events', 'EventsController@index')->name('events.index');
    Route::get('/events/search', 'EventsController@search')->name('events.search');
    Route::post('/events', 'EventsController@store')->name('events.store');
    Route::get('organizer/events', 'EventsController@getOrganizerEvents')->name('organizer.events')->middleware('active');
    Route::get('/events/create', 'EventsController@create')->name('events.create')->middleware('organizer');
    Route::get('/events/{id}', 'EventsController@show')->name('events.show');
    //orders
    Route::get('events/{id}/orders', 'OrderController@index')->name('orders.index')->middleware('active');
    Route::get('/events/{id}/orders/create', 'OrderController@create')->name('orders.create')->middleware('organizer');
    Route::post('/orders', 'OrderController@store')->name('orders.store')->middleware('active');
    Route::get('/orders/{id}', 'OrderController@show')->name('orders.show')->middleware('active');
    Route::get('/orders/{id}/confirm', 'OrderController@confirm')->name('orders.confirm')->middleware('active');
    //offers
    Route::get('/offers', 'OffersController@index')->name('offers.index')->middleware('active');
    Route::get('/offers/create', 'OffersController@create')->name('offers.create')->middleware('active');
    Route::post('/offers', 'OffersController@store')->name('offers.store')->middleware('active');
    Route::get('/offers/{id}', 'OffersController@show')->name('offers.show')->middleware('active');
    Route::get('/offers/{id}/confirm', 'OffersController@confirm')->name('offers.confirm')->middleware('active');
    //booth
    Route::get('event/{id}/booth/create','BoothController@create')->name('booth.create')->middleware('organizer'); 
    Route::post('/booth/create','BoothController@store')->name('booth.store'); 
    Route::get('/booth','BoothController@index')->name('booth.index')->middleware('active'); 
    Route::get('event/{id}/booth/show','BoothController@show')->name('booth.show'); 
    Route::get('event/{event_id}/booth/{booth_id}/hire','BoothController@hire')->name('booth.hire');
    Route::post('booth/pay','BoothController@pay')->name('booth.pay');
    Route::delete('/booth/{id}','BoothController@destroy')->name('booth.destroy');
    //tickets
    Route::get('/tickets/{id?}', 'TicketsController@index')->name('tickets.index')->middleware('active');
    Route::post('/event/tickets', 'TicketsController@getEventTickets')->name('event.tickets');
    Route::any('/tickets/pay', 'TicketsController@payPage')->name('tickets.pay');
    Route::get('/tickets/QR_code', 'TicketsController@generateQRCode')->name('tickets.qrCode');
    Route::get('/event/{id}/tickets/create','TicketsController@create')->name('tickets.create')->middleware('organizer'); 
    Route::post('/tickets','TicketsController@store')->name('tickets.store'); 
    Route::get('/tickets/{id}/show','TicketsController@show')->name('tickets.show'); 
    Route::delete('/tickets/{id}','TicketsController@destroy')->name('tickets.destroy');
    Route::get('users/{user_id}/events/{event_id}/verify','TicketsController@verifyTicket')->name('tickets.verify'); 
    // Route::get('/tickets','TicketsController@index')->name('tickets.index'); 
    // Route::get('event/{id}/booth/show','BoothController@show')->name('booth.show'); 
    // Route::get('event/{event_id}/booth/{booth_id}/hire','BoothController@hire')->name('booth.hire'); 
    //payments
    Route::get('payment/register_fee','PaymentController@getRegisterationFeePage')->name('payment.register');
    Route::get('payment/register_fee/pay','PaymentController@payRegistrationFee');
    //consultation
    Route::get('consultations/create','ConsultationController@create')->name('consultations.create');
    Route::post('consultations','ConsultationController@store')->name('consultations.store');
    //redirections
    Route::get('/redirect/organizer','PagesController@redirectOrganizerPage')->name('redirect.organizer');
    Route::get('redirect/active','PagesController@redirectActivePage')->name('redirect.active');

});


Auth::routes(['register' => false]);
// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
Route::resource('users', 'UsersController');
});
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
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
   

    // Events
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventController');
    Route::get('events/activate/{id}', 'EventController@activate')->name('events.activate');
    Route::get('events/suspend/{id}', 'EventController@suspend')->name('events.suspend');

    // Categories
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Orders
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::post('orders/media', 'OrderController@storeMedia')->name('orders.storeMedia');
    Route::post('orders/ckmedia', 'OrderController@storeCKEditorImages')->name('orders.storeCKEditorImages');
    Route::resource('orders', 'OrderController');

    // Offers
    Route::delete('offers/destroy', 'OfferController@massDestroy')->name('offers.massDestroy');
    Route::post('offers/media', 'OfferController@storeMedia')->name('offers.storeMedia');
    Route::post('offers/ckmedia', 'OfferController@storeCKEditorImages')->name('offers.storeCKEditorImages');
    Route::resource('offers', 'OfferController');

    // Articles
    Route::delete('articles/destroy', 'ArticleController@massDestroy')->name('articles.massDestroy');
    Route::post('articles/media', 'ArticleController@storeMedia')->name('articles.storeMedia');
    Route::post('articles/ckmedia', 'ArticleController@storeCKEditorImages')->name('articles.storeCKEditorImages');
    Route::resource('articles', 'ArticleController');

    // Cities
    Route::delete('cities/destroy', 'CityController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CityController');
    // Booths
    Route::delete('booths/destroy', 'BoothController@massDestroy')->name('booths.massDestroy');
    Route::post('booths/media', 'BoothController@storeMedia')->name('booths.storeMedia');
    Route::post('booths/ckmedia', 'BoothController@storeCKEditorImages')->name('booths.storeCKEditorImages');
    Route::resource('booths', 'BoothController');

    // Booth Details
    Route::delete('booth-details/destroy', 'BoothDetailsController@massDestroy')->name('booth-details.massDestroy');
    Route::resource('booth-details', 'BoothDetailsController');
     // Configrations
     Route::delete('configrations/destroy', 'ConfigrationController@massDestroy')->name('configrations.massDestroy');
     Route::resource('configrations', 'ConfigrationController');
 
     // Coupons
     Route::delete('coupons/destroy', 'CouponController@massDestroy')->name('coupons.massDestroy');
     Route::resource('coupons', 'CouponController');
      // Consultations
    Route::delete('consultations/destroy', 'ConsultationController@massDestroy')->name('consultations.massDestroy');
    Route::resource('consultations', 'ConsultationController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
