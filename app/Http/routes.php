<?php

Route::auth();
Route::singularResourceParameters();


Route::get('invoice/view/{client_id}/{unique_id}', [
    'as' => 'invoice.view',
    'uses' => 'InvoicesController@view'
]);

Route::get('invoice/pay/{client_id}/{unique_id}', [

    'as' => 'invoice.pay',
    'uses' => 'InvoicesController@pay'

]);

Route::post('invoice/pay', [

    'as' => 'invoice.process-payment',
    'uses' => 'InvoicesController@processPayment'

]);

Route::group(['middleware' => 'auth'], function()
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('dashboard', [

        'as' => 'dashboard',
        'uses' => 'DashboardController@index'

    ]);

    /*
    |--------------------------------------------------------------------------
    | Clients
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::resource('clients/contacts', 'ClientContactsController', ['except' => ['index', 'show']]);
    Route::resource('clients', 'ClientsController');

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('settings/edit', ['as' => 'settings.edit', 'uses' => 'SettingsController@edit']);
    Route::put('settings', ['as' => 'settings.update', 'uses' => 'SettingsController@update']);
    Route::get('settings/remove-stripe', ['as' => 'settings.remove-stripe', 'uses' => 'SettingsController@removeStripeKeys']);

    /*
    |--------------------------------------------------------------------------
    | Work Orders
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::put('work-orders/toggle-completion', 'WorkOrdersController@toggleCompletion');
    Route::resource('invoices/work-orders', 'WorkOrdersController', ['except' => ['index', 'show', 'edit', 'update'], 'parameters' => [
        'work-orders' => 'workOrder']]);
    Route::resource('work-orders', 'WorkOrdersController', ['only' => ['index', 'show', 'edit', 'update'], 'parameters' => [
        'work-orders' => 'workOrder']]);

    /*
    |--------------------------------------------------------------------------
    | Times
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('times/create/{workorderId}', 'TimesController@create');
    Route::put('times/toggle', 'TimesController@toggle');
    Route::resource('times', 'TimesController', ['except' => ['index', 'show']]);

    /*
    |--------------------------------------------------------------------------
    | Tasks
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('tasks/create/{resource}', 'TasksController@create');
    Route::put('tasks/toggle/{task}', 'TasksController@toggle');
    Route::resource('tasks', 'TasksController', ['except' => ['index', 'show']]);

    /*
    |--------------------------------------------------------------------------
    | Notes
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::resource('notes', 'NotesController', ['except' => ['index', 'show']]);

    /*
    |--------------------------------------------------------------------------
    | Invoicing
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::resource('invoices/invoice-items', 'InvoiceItemsController', ['except' => ['index', 'show'], 'parameters' => [
        'invoice-items' => 'invoiceItem']]);
    Route::resource('invoices/payments', 'PaymentsController', ['except' => ['index', 'show']]);
    Route::resource('invoices', 'InvoicesController');

});