<?php

use App\Models\Customer\CustomerEmployment;
use Carbon\Carbon;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('home');

//route for customer
Route::post('customer/store', 'Customer\CustomerController@store');


//route for gurator
Route::post('gurantor/store', 'Customer\GurantorController@store');
Route::post('gurantor/delete', 'Customer\GurantorController@destroy');

//Route::post('product/store', 'Loan\ProductController@store');//*****Testing Route */

//route for loans
Route::group(['prefix' => 'loan'], function () {


//*******routes for loan********
Route::get('loan', 'Loan\LoanController@index');
Route::get('loan/create', 'Loan\LoanController@create');
Route::get('loan/view', 'Loan\LoanController@index');
Route::post('loan/store', 'Loan\LoanController@store');
Route::get('loan/{product}', 'Loan\LoanController@show');
Route::post('loan/{id}/update', 'Loan\LoanController@update');
//Route::get('product/{id}/delete', 'Loan\ProductController@delete');


//******* routes for loan request ****
Route::get('loan/show/request', 'Loan\LoanController@loanRequest');
Route::get('loan/show/decline', 'Loan\LoanController@loanDecline');
Route::get('loan/show-request/{id}', 'Loan\LoanController@showLoanRequest');

//route for loan confirmation, disbursement and rejection
Route::post('loan/confirm', 'Loan\LoanController@confirmLoan');
Route::post('loan/reject', 'Loan\LoanController@rejectLoan');
Route::post('loan/decline', 'Loan\LoanController@decline');
Route::post('loan/approve', 'Loan\LoanController@approveLoan');
Route::post('loan/changeprincipalamount', 'Loan\LoanController@changePrincipalAmount');

//route for disbursement
Route::get('loan/disburse/loan', 'Loan\LoanController@disburseLoan');
Route::post('loan/disbursement', 'Loan\LoanController@loanDisbursement');
Route::post('loan/reject/disbursement', 'Loan\LoanController@rejectLoanDisbursement');

//rout for loan details
Route::get('loan/showloan-detail/{id}', 'Loan\LoanController@showLoanDetail');




//route for loan comment
Route::post('loan/comment/store', 'Loan\LoanController@storeCoemment');
Route::post('loan/comment/delete', 'Loan\LoanController@destroyComment');

//route to set confirmation process
Route::get('confirmation-process', 'Loan\LoanConfirmationProcessController@index');
Route::get('confirmation-process/create', 'Loan\LoanConfirmationProcessController@create');
Route::post('store/confirmationproccess', 'Loan\LoanConfirmationProcessController@store');
Route::get('confirmation-process/{id}', 'Loan\LoanConfirmationProcessController@show');
Route::post('confirmation-process/update', 'Loan\LoanConfirmationProcessController@update');
Route::get('confirmation-process/delete/{id}', 'Loan\LoanConfirmationProcessController@destroy');
});

//route for customer
Route::group(['prefix' => 'customer'], function () {
    //*******routes for product********
    Route::get('view', 'Customer\CustomerController@index');
    Route::get('create', 'Customer\CustomerController@create');
    //Route::post('store', 'Customer\CustomerController@store');

    Route::get('create', 'Customer\CustomerController@create');
    Route::post('store/generationinfo', 'Customer\CustomerController@store');

    Route::get('create/employment', 'Customer\CustomerController@createEmployment');
    Route::post('store/employment', 'Customer\CustomerController@storeEmployment');

    Route::get('create/guarantor', 'Customer\CustomerController@createGuarantor');
    Route::post('store/guarantor', 'Customer\CustomerController@storeGuarantor');

    Route::get('create/loan', 'Customer\CustomerController@createLoan');
    Route::post('store/loan', 'Customer\CustomerController@storeLoan');

    Route::get('create/file', 'Customer\CustomerController@createFile');
    Route::post('store/file', 'Customer\CustomerController@storeFile');

    Route::get('view/in-complete-reg', 'Customer\CustomerController@incompleteReg');
    Route::get('registration/continue/{id}/{type}', 'Customer\CustomerController@completeReg');
});

//route for privileges
Route::group(['prefix' => 'admin'], function () {
//privileges
Route::get('/privileges', 'Admin\PrivilegesController@index');
Route::get('/add/privilege', 'Admin\PrivilegesController@create');
Route::post('/store/privilege', 'Admin\PrivilegesController@store');
Route::get('/edit/privilege/{id}', 'Admin\PrivilegesController@show');
Route::post('/update/privilege', 'Admin\PrivilegesController@update');

});

//route for Offer Letter
Route::group(['prefix' => 'admin'], function () {
    //privileges
    Route::get('/offer-letter', 'Admin\OfferLetterController@index');
    Route::get('/create/offer-letter', 'Admin\OfferLetterController@create');
    Route::post('/store/offer-letter', 'Admin\OfferLetterController@store');
    Route::get('/edit/offer-letter/{id}', 'Admin\OfferLetterController@show');
    Route::post('/update/offer-letter', 'Admin\OfferLetterController@update');

    });

//Route to view an audit trial
Route::get('/audit/logs/{id}/{type}', 'Admin\AuditTrialController@index');
Route::get('rate', function(){
     return(Carbon::now()->addMonth()->day(7)->format('Y-m-d'));
});
