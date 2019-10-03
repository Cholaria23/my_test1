<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin']
], function () {

    Route::get('/', function () {
        return view('backend.layouts.app');
    });

    Route::post('/upload-image-from-admin', 'ImagesController@upload');

    Route::group(['prefix' => 'articleCategory'], function () {
        Route::post('/', ['uses' => 'ArticleCategoryController@index']);
        Route::post('/store', ['uses' => 'ArticleCategoryController@store']);
        Route::post('/show/{id}', ['uses' => 'ArticleCategoryController@show']);
        Route::post('/update/{id}', ['uses' => 'ArticleCategoryController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'ArticleCategoryController@destroy']);
        Route::post('/destroyList', ['uses' => 'ArticleCategoryController@destroyList']);
    });

    Route::group(['prefix' => 'article'], function () {
        Route::post('/', ['uses' => 'ArticleController@index']);
        Route::post('/store', ['uses' => 'ArticleController@store']);
        Route::post('/show/{id}', ['uses' => 'ArticleController@show']);
        Route::post('/update/{id}', ['uses' => 'ArticleController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'ArticleController@destroy']);
        Route::post('/destroyList', ['uses' => 'ArticleController@destroyList']);
    });
    Route::get('/articleCategoryRelation', ['uses' => 'ArticleController@articleCategoryRelation']);

    Route::group(['prefix' => 'workplace'], function () {
        Route::post('/', ['uses' => 'WorkplaceController@index']);
        Route::post('/store', ['uses' => 'WorkplaceController@store']);
        Route::post('/show/{id}', ['uses' => 'WorkplaceController@show']);
        Route::post('/update/{id}', ['uses' => 'WorkplaceController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'WorkplaceController@destroy']);
        Route::post('/destroyList', ['uses' => 'WorkplaceController@destroyList']);
    });

    Route::group(['prefix' => 'poster'], function () {
        Route::post('/', ['uses' => 'PosterController@index']);
        Route::post('/store', ['uses' => 'PosterController@store']);
        Route::post('/show/{id}', ['uses' => 'PosterController@show']);
        Route::post('/update/{id}', ['uses' => 'PosterController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'PosterController@destroy']);
        Route::post('/destroyList', ['uses' => 'PosterController@destroyList']);
    });
    Route::get('/posterCategoryRelation', ['uses' => 'PosterController@posterCategoryRelation']);

    Route::group(['prefix' => 'subscriber'], function () {
        Route::post('/', ['uses' => 'SubscriberController@index']);
        Route::post('/store', ['uses' => 'SubscriberController@store']);
        Route::post('/show/{id}', ['uses' => 'SubscriberController@show']);
        Route::post('/update/{id}', ['uses' => 'SubscriberController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'SubscriberController@destroy']);
        Route::post('/destroyList', ['uses' => 'SubscriberController@destroyList']);
    });

    Route::group(['prefix' => 'page'], function () {
        Route::post('/', ['uses' => 'PageController@index']);
        Route::post('/store', ['uses' => 'PageController@store']);
        Route::post('/show/{id}', ['uses' => 'PageController@show']);
        Route::post('/update/{id}', ['uses' => 'PageController@update']);
//        Route::delete('/destroy/{id}', ['uses' => 'PageController@destroy']);
//        Route::post('/destroyList', ['uses' => 'PageController@destroyList']);
    });

    Route::group(['prefix' => 'formRequest'], function () {
        Route::post('/', ['uses' => 'FormRequestController@index']);
        Route::post('/store', ['uses' => 'FormRequestController@store']);
        Route::post('/show/{id}', ['uses' => 'FormRequestController@show']);
        Route::post('/update/{id}', ['uses' => 'FormRequestController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'FormRequestController@destroy']);
        Route::post('/destroyList', ['uses' => 'FormRequestController@destroyList']);
    });

    Route::group(['prefix' => 'workplaceRequest'], function () {
        Route::post('/', ['uses' => 'FormRequestController@index']);
        Route::post('/store', ['uses' => 'FormRequestController@store']);
        Route::post('/show/{id}', ['uses' => 'FormRequestController@show']);
        Route::post('/update/{id}', ['uses' => 'FormRequestController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'FormRequestController@destroy']);
        Route::post('/destroyList', ['uses' => 'FormRequestController@destroyList']);
    });

    Route::group(['prefix' => 'serviceCenters'], function () {
        Route::post('/', ['uses' => 'ServiceCenterController@index']);
        Route::post('/store', ['uses' => 'ServiceCenterController@store']);
        Route::post('/show/{id}', ['uses' => 'ServiceCenterController@show']);
        Route::post('/update/{id}', ['uses' => 'ServiceCenterController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'ServiceCenterController@destroy']);
        Route::post('/destroyList', ['uses' => 'ServiceCenterController@destroyList']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('/', ['uses' => 'UserController@index']);
        Route::post('/store', ['uses' => 'UserController@store']);
        Route::post('/show/{id}', ['uses' => 'UserController@show']);
        Route::post('/update/{id}', ['uses' => 'UserController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'UserController@destroy']);
        Route::post('/destroyList', ['uses' => 'UserController@destroyList']);
    });
    Route::get('/roleRelation', ['uses' => 'UserController@roleRelation']);

    Route::group(['prefix' => 'schools'], function () {
        Route::post('/', ['uses' => 'SchoolController@index']);
        Route::post('/store', ['uses' => 'SchoolController@store']);
        Route::post('/show/{id}', ['uses' => 'SchoolController@show']);
        Route::post('/update/{id}', ['uses' => 'SchoolController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'SchoolController@destroy']);
        Route::post('/destroyList', ['uses' => 'SchoolController@destroyList']);
    });
    Route::get('/schoolCategoryRelation', ['uses' => 'SchoolController@schoolCategoryRelation']);

    Route::group(['prefix' => 'schoolCategory'], function () {
        Route::post('/', ['uses' => 'SchoolCategoryController@index']);
        Route::post('/store', ['uses' => 'SchoolCategoryController@store']);
        Route::post('/show/{id}', ['uses' => 'SchoolCategoryController@show']);
        Route::post('/update/{id}', ['uses' => 'SchoolCategoryController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'SchoolCategoryController@destroy']);
        Route::post('/destroyList', ['uses' => 'SchoolCategoryController@destroyList']);
    });

    Route::group(['prefix' => 'courses'], function () {
        Route::post('/', ['uses' => 'CourseController@index']);
        Route::post('/store', ['uses' => 'CourseController@store']);
        Route::post('/show/{id}', ['uses' => 'CourseController@show']);
        Route::post('/update/{id}', ['uses' => 'CourseController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'CourseController@destroy']);
        Route::post('/destroyList', ['uses' => 'CourseController@destroyList']);
    });
    Route::get('/courseSchool', ['uses' => 'CourseController@courseSchoolRelation']);

    Route::group(['prefix' => 'maintenanceCenters'], function () {
        Route::post('/', ['uses' => 'MaintenanceCentersController@index']);
        Route::post('/store', ['uses' => 'MaintenanceCentersController@store']);
        Route::post('/show/{id}', ['uses' => 'MaintenanceCentersController@show']);
        Route::post('/update/{id}', ['uses' => 'MaintenanceCentersController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'MaintenanceCentersController@destroy']);
        Route::post('/destroyList', ['uses' => 'MaintenanceCentersController@destroyList']);
    });
    Route::get('/maintenanceCityRelation', ['uses' => 'MaintenanceCentersController@maintenanceCityRelation']);

    Route::group(['prefix' => 'reviews'], function () {
        Route::post('/', ['uses' => 'ReviewController@index']);
        Route::post('/store', ['uses' => 'ReviewController@store']);
        Route::post('/show/{id}', ['uses' => 'ReviewController@show']);
        Route::post('/update/{id}', ['uses' => 'ReviewController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'ReviewController@destroy']);
        Route::post('/destroyList', ['uses' => 'ReviewController@destroyList']);
    });

    Route::group(['prefix' => 'file'], function () {
        Route::post('/', ['uses' => 'FileController@index']);
        Route::post('/store', ['uses' => 'FileController@store']);
        Route::post('/show/{id}', ['uses' => 'FileController@show']);
        Route::post('/update/{id}', ['uses' => 'FileController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'FileController@destroy']);
        Route::post('/destroyList', ['uses' => 'FileController@destroyList']);
    });
    Route::get('/fileCategoryRelation', ['uses' => 'FileController@fileCategoryRelation']);

    Route::group(['prefix' => 'fileCategory'], function () {
        Route::post('/', ['uses' => 'FileCategoryController@index']);
        Route::post('/store', ['uses' => 'FileCategoryController@store']);
        Route::post('/show/{id}', ['uses' => 'FileCategoryController@show']);
        Route::post('/update/{id}', ['uses' => 'FileCategoryController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'FileCategoryController@destroy']);
        Route::post('/destroyList', ['uses' => 'FileCategoryController@destroyList']);
    });

    Route::group(['prefix' => 'faq'], function () {
        Route::post('/', ['uses' => 'FaqController@index']);
        Route::post('/store', ['uses' => 'FaqController@store']);
        Route::post('/show/{id}', ['uses' => 'FaqController@show']);
        Route::post('/update/{id}', ['uses' => 'FaqController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'FaqController@destroy']);
        Route::post('/destroyList', ['uses' => 'FaqController@destroyList']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::post('/', ['uses' => 'ProductController@index']);
        Route::post('/store', ['uses' => 'ProductController@store']);
        Route::post('/show/{id}', ['uses' => 'ProductController@show']);
        Route::post('/update/{id}', ['uses' => 'ProductController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'ProductController@destroy']);
        Route::post('/destroyList', ['uses' => 'ProductController@destroyList']);
    });
    Route::get('/productCategoryRelation', ['uses' => 'ProductController@productCategoryRelation']);
    Route::get('/appointmentRelation', ['uses' => 'ProductController@appointmentRelation']);
    Route::get('/countryRelation', ['uses' => 'ProductController@countryRelation']);
    Route::get('/articleRelation', ['uses' => 'ProductController@articleRelation']);
    Route::get('/productRelation', ['uses' => 'ProductController@productRelation']);
    Route::get('/attributeRelation/{id}', ['uses' => 'ProductController@attributeRelation']);

    Route::group(['prefix' => 'productCategory'], function () {
        Route::post('/', ['uses' => 'ProductCategoryController@index']);
        Route::post('/store', ['uses' => 'ProductCategoryController@store']);
        Route::post('/show/{id}', ['uses' => 'ProductCategoryController@show']);
        Route::post('/update/{id}', ['uses' => 'ProductCategoryController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'ProductCategoryController@destroy']);
        Route::post('/destroyList', ['uses' => 'ProductCategoryController@destroyList']);
    });
    Route::get('/serialRelation', ['uses' => 'ProductCategoryController@serialRelation']);
    Route::get('/attributeCategoryRelation', ['uses' => 'ProductController@attributeCategoryRelation']);

    Route::group(['prefix' => 'attribute'], function () {
        Route::post('/', ['uses' => 'AttributeController@index']);
        Route::post('/store', ['uses' => 'AttributeController@store']);
        Route::post('/show/{id}', ['uses' => 'AttributeController@show']);
        Route::post('/update/{id}', ['uses' => 'AttributeController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'AttributeController@destroy']);
        Route::post('/destroyList', ['uses' => 'AttributeController@destroyList']);
    });
    Route::get('/attributeCategoryRelation', ['uses' => 'AttributeController@attributeCategoryRelation']);

    Route::group(['prefix' => 'attributeCategory'], function () {
        Route::post('/', ['uses' => 'AttributeCategoryController@index']);
        Route::post('/store', ['uses' => 'AttributeCategoryController@store']);
        Route::post('/show/{id}', ['uses' => 'AttributeCategoryController@show']);
        Route::post('/update/{id}', ['uses' => 'AttributeCategoryController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'AttributeCategoryController@destroy']);
        Route::post('/destroyList', ['uses' => 'AttributeCategoryController@destroyList']);
    });

    Route::group(['prefix' => 'serial'], function () {
        Route::post('/', ['uses' => 'SerialController@index']);
        Route::post('/store', ['uses' => 'SerialController@store']);
        Route::post('/show/{id}', ['uses' => 'SerialController@show']);
        Route::post('/update/{id}', ['uses' => 'SerialController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'SerialController@destroy']);
        Route::post('/destroyList', ['uses' => 'SerialController@destroyList']);
    });

    Route::group(['prefix' => 'country'], function () {
        Route::post('/', ['uses' => 'CountryController@index']);
        Route::post('/store', ['uses' => 'CountryController@store']);
        Route::post('/show/{id}', ['uses' => 'CountryController@show']);
        Route::post('/update/{id}', ['uses' => 'CountryController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'CountryController@destroy']);
        Route::post('/destroyList', ['uses' => 'CountryController@destroyList']);
    });
    Route::get('/countryCategoryRelation', ['uses' => 'CountryController@countryCategoryRelation']);

    Route::group(['prefix' => 'city'], function () {
        Route::post('/', ['uses' => 'CityController@index']);
        Route::post('/store', ['uses' => 'CityController@store']);
        Route::post('/show/{id}', ['uses' => 'CityController@show']);
        Route::post('/update/{id}', ['uses' => 'CityController@update']);
        Route::delete('/destroy/{id}', ['uses' => 'CityController@destroy']);
        Route::post('/destroyList', ['uses' => 'CityController@destroyList']);
    });
    Route::get('/cityCountryRelation', ['uses' => 'CityController@cityCountryRelation']);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

});


