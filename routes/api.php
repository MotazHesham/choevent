<?php

Route::any('tickets/payments/feedback','Website\TicketsController@getPaymentFeedback');
Route::any('booth/payments/feedback','Website\BoothController@getPaymentFeedback');
Route::any('users/payments/feedback','Website\Auth\RegisterController@getPaymentFeedback');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Events
    Route::post('events/media', 'EventApiController@storeMedia')->name('events.storeMedia');
    Route::apiResource('events', 'EventApiController');

    // Categories
    Route::apiResource('categories', 'CategoryApiController');

    // Orders
    Route::post('orders/media', 'OrderApiController@storeMedia')->name('orders.storeMedia');
    Route::apiResource('orders', 'OrderApiController');

    // Offers
    Route::post('offers/media', 'OfferApiController@storeMedia')->name('offers.storeMedia');
    Route::apiResource('offers', 'OfferApiController');

    // Articles
    Route::post('articles/media', 'ArticleApiController@storeMedia')->name('articles.storeMedia');
    Route::apiResource('articles', 'ArticleApiController');

    // Cities
    Route::apiResource('cities', 'CityApiController');
    // Booths
    Route::post('booths/media', 'BoothApiController@storeMedia')->name('booths.storeMedia');
    Route::apiResource('booths', 'BoothApiController');

    // Booth Details
    Route::apiResource('booth-details', 'BoothDetailsApiController');
});
