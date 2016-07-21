<?php

Route::auth();
Route::singularResourceParameters();

//
//Route::get('invoice/view/{client_id}/{unique_id}', [
//    'as' => 'invoice.view',
//    'uses' => 'InvoicesController@view'
//]);
//
//Route::get('invoice/pay/{client_id}/{unique_id}', array(
//
//    'as' => 'invoice.pay',
//    'uses' => 'InvoicesController@pay'
//
//));
//
//Route::post('invoice/pay', array(
//
//    'as' => 'invoice.process_payment',
//    'uses' => 'InvoicesController@process_payment'
//
//));
//
Route::group(['middleware' => 'auth'], function()
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('dashboard', array(

        'as' => 'dashboard',
        'uses' => 'DashboardController@index'

    ));

//    /*
//    |--------------------------------------------------------------------------
//    | Clients
//    |--------------------------------------------------------------------------
//    |
//    |
//    */
//
    Route::resource('clients/contacts', 'ClientContactsController', ['except' => ['index', 'show']]);
    Route::resource('clients', 'ClientsController');
//
//    /*
//    |--------------------------------------------------------------------------
//    | Account
//    |--------------------------------------------------------------------------
//    |
//    |
//    */
//
//    Route::get('account', 'AccountController@index');
//    Route::get('account/billing', 'AccountController@billing');
//    Route::get('account/edit', 'AccountController@edit');
//    Route::patch('account/edit', array(
//        'before' => 'csrf',
//        'as' => 'account.update',
//        'uses' => 'AccountController@update'
//
//    ));
//    Route::get('account/select/{id}', 'AccountController@select');
//
//    Route::resource('account/workorder_types', 'WorkorderTypesController');
//
//    Route::resource('account/stripe', 'StripeController');
//
//    /*
//    |--------------------------------------------------------------------------
//    | Work Orders
//    |--------------------------------------------------------------------------
//    |
//    |
//    */
//
//    Route::get('workorders/completed', 'WorkordersController@completed');
//    Route::get('workorders/mark_completed/{id}', array(
//        'before' => 'ajax',
//        'uses' => 'TasksController@mark_completed'
//    ));
//    Route::get('workorders/move_task/{ids}', 'TasksController@move_task');
//    Route::get('workorders/scheduled', 'WorkordersController@scheduled');
//    Route::get('workorders/unscheduled', 'WorkordersController@unscheduled');
//    Route::get('workorders/overview', 'WorkordersController@overview');
//
//    /*
//    |--------------------------------------------------------------------------
//    | Times
//    |--------------------------------------------------------------------------
//    |
//    |
//    */
//
    Route::get('times/create/{workorderId}', 'TimesController@create');
    Route::put('times/toggle', 'TimesController@toggle');
    Route::resource('times', 'TimesController', ['except' => ['index', 'show']]);
//
//    /*
//    |--------------------------------------------------------------------------
//    | Tasks
//    |--------------------------------------------------------------------------
//    |
//    |
//    */
//
    Route::get('tasks/create/{resource}', 'TasksController@create');
    Route::put('tasks/toggle/{task}', 'TasksController@toggle');
    Route::resource('tasks', 'TasksController', ['except' => ['index', 'show']]);
//
//    /*
//    |--------------------------------------------------------------------------
//    | Search
//    |--------------------------------------------------------------------------
//    |
//    |
//    */
//    // Route::get('search', 'SearchController@index');
//    Route::post('search/results', 'SearchController@results');
//
//    /*
//    |--------------------------------------------------------------------------
//    | Notes
//    |--------------------------------------------------------------------------
//    |
//    |
//    */
//
    Route::resource('notes', 'NotesController', ['except' => ['index', 'show']]);
//
//    /*
//    |--------------------------------------------------------------------------
//    | Invoicing
//    |--------------------------------------------------------------------------
//    |
//    |
//    */
//
//    Route::get('invoices/{id}/send', array('as' => 'invoices.send', 'uses' => 'InvoicesController@send'));
//    Route::post('invoices/{id}/send', array(
//        'before' => 'csrf',
//        'as' => 'invoices.mail',
//        'uses' => 'InvoicesController@mail'
//    ));
//    Route::get('invoices/{id}/delete', array(
//        'as' => 'invoices.delete',
//        'uses' => 'InvoicesController@remove'
//    ));
//    Route::get('invoices/paid', 'InvoicesController@paid');
//    Route::get('invoices/overview', 'InvoicesController@overview');
//
//    Route::get('invoices/{id}', function($id)
//    {
//        $invoice = new App\Repositories\InvoiceRepository;
//
//        $inv = $invoice->get($id);
//
//        Session::reflash();
//
//        return Redirect::to(url('invoice/view/' . $inv->client_id . '/' . $inv->unique_id));
//    })->where('id', '[0-9]+');
//
    Route::resource('invoices/invoice-items', 'InvoiceItemsController', ['except' => ['index', 'show'], 'parameters' => [
        'invoice-items' => 'invoiceItem']]);
    Route::resource('invoices/payments', 'PaymentsController', ['except' => ['index', 'show']]);
    Route::resource('invoices/work-orders', 'WorkOrdersController', ['except' => ['index', 'show', 'edit', 'store'], 'parameters' => [
        'work-orders' => 'workOrder']]);
    Route::resource('work-orders', 'WorkOrdersController', ['only' => ['index', 'show', 'edit', 'store'], 'parameters' => [
        'work-orders' => 'workOrder']]);
    Route::resource('invoices', 'InvoicesController');

//
//
//    Route::get('invoice_item', 'AjaxViewController@invoice_item');
//    Route::get('invoice_workorders/{client_id}', 'AjaxViewController@workorders');
//
//    Route::get('payment', 'AjaxViewController@payment');
//
//    Route::group(array('before' => 'ajax'), function()
//    {
//        Route::get('feedback', function()
//        {
//            $output['html'] = View::make('feedback.form')->render();
//
//            echo json_encode($output);
//        });
//
//        Route::post('feedback', ['before' => 'csrf', function()
//        {
//            $feedback = Feedback::create(Input::all());
//
//            if($feedback)
//            {
//                $feedback->user_id = getUserId();
//                $feedback->account_id = getAccountId();
//                $feedback->save();
//
//                $data['user'] = Auth::user();
//                $data['feedback'] = $feedback;
//
//                //send email with link to activate.
//                Mail::send('emails.feedback.new', $data, function($message) use($data)
//                {
//                    $message->to('admin@worktop.co')->subject('New Feedback');
//                    $message->from('website@worktop.co', 'WorkTop Website');
//                });
//
//                $output['html'] = View::make('feedback.success')->render();
//            }
//            else
//            {
//                $output['html'] = View::make('feedback.error')->render();
//            }
//
//            echo json_encode($output);
//        }]);
//    });
//
//    Route::get('helpbar', 'AjaxViewController@helpbar');

});
//
///*
//|--------------------------------------------------------------------------
//| Auth
//|--------------------------------------------------------------------------
//|
//|
//*/
//
//Route::get('login', array(
//
//    'before' => 'guest',
//    'as' => 'login',
//
//    function()
//    {
//        return View::make('auth.login');
//    }
//
//));
//
//Route::post('login', array('before' => 'csrf', 'uses' => 'AuthController@processLogin'));
//
//Route::get('register', array(
//
//    'before' => 'guest',
//    'as' => 'register',
//    function()
//    {
//        dd('Sorry, not excepting registrations at this time.');
//        return View::make('auth.register');
//    }
//
//));
//
////Route::post('register', [
////	'before' => 'csrf',
////	'uses' => 'AuthController@processRegistration'
////	]);
//
//Route::get('recover_password', array(
//
//    'as' => 'auth.recover_password',
//    'uses' => 'AuthController@resetPassword'
//
//));
//
//Route::get('activate/{userID}/{activationCode}', array(
//
//    'as' => 'auth.activate',
//    'uses' => 'AuthController@activate'
//
//));
//
//Route::get('logout', array(
//
//    'as' => 'logout',
//    function()
//    {
//        Session::flush();
//        Auth::logout();
//        return Redirect::route('home');
//    }
//));
//
//Route::controller('password', 'RemindersController');

Route::get('/home', 'HomeController@index');
