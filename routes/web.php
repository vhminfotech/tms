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



Route::get('/', function() {
            return Redirect::to('index');
        });
//Route::get('/', function() { return Redirect::to('login'); });


Route::match(['get', 'post'], 'index', ['as' => 'login', 'uses' => 'LoginController@auth']);
Route::match(['get', 'post'], 'login', ['as' => 'login', 'uses' => 'LoginController@auth']);
Route::match(['get', 'post'], 'logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
Route::match(['get', 'post'], 'register', ['as' => 'register', 'uses' => 'LoginController@auth']);


$userPrefix = "";
Route::group(['prefix' => $userPrefix, 'middleware' => ['auth']], function() {
            Route::match(['get', 'post'], 'worker/worker-dashboard', ['as' => 'worker-dashboard', 'uses' => 'UserController@dashboard']);
            Route::match(['get', 'post'], '/worker/workerdash-search-list', ['as' => 'workerdash-search-list', 'uses' => 'UserController@getworkersearchList']);
        });

$customerPrefix = "";
Route::group(['prefix' => $customerPrefix, 'middleware' => ['customer']], function() {
            Route::match(['get', 'post'], '/supervisor/supervisor-dashboard', ['as' => 'customer-dashboard', 'uses' => 'Customer\CustomerController@dashboard']);
            Route::match(['get', 'post'], '/supervisor/information_supervisor', ['as' => 'information_supervisor', 'uses' => 'Customer\InformationSupervisorController@dashboard']);
            Route::match(['get', 'post'], '/supervisor/timesheet_list', ['as' => 'timesheet_list', 'uses' =>
                'Customer\TimesheetSupervisorController@timesheet_list']);
            Route::match(['get', 'post'], '/supervisor/timesheet-search', ['as' => 'timesheet-search', 'uses' => 'Customer\TimesheetSupervisorController@getsearchTimesheetList']);
            Route::match(['get', 'post'], '/supervisor/information-search-list', ['as' => 'information-search-list', 'uses' => 'Customer\TimesheetSupervisorController@getsearchInformationList']);
            Route::match(['get', 'post'], '/supervisor/dash-search-list', ['as' => 'dash-search-list', 'uses' => 'Customer\TimesheetSupervisorController@getdassearchInformationList']);
        });

$ageentPrefix = "";
Route::group(['prefix' => $ageentPrefix, 'middleware' => ['agent']], function() {
            Route::match(['get', 'post'], '/agent/agent-dashboard', ['as' => 'agent-dashboard', 'uses' => 'Agent\AgentController@dashboard']);
        });

$adminPrefix = "";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
            Route::match(['get', 'post'], '/admin/admin-dashboard', ['as' => 'admin-dashboard', 'uses' => 'Admin\AdminController@dashboard']);
            Route::match(['get', 'post'], '/admin/dashboard/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\AdminController@ajaxAction']);
            Route::match(['get', 'post'], '/admin/user-list', ['as' => 'user-list', 'uses' => 'Admin\AdminController@getUserData']);
            Route::match(['get', 'post'], '/admin/add-user', ['as' => 'add-user', 'uses' => 'Admin\AdminController@addUser']);
            Route::match(['get', 'post'], '/admin/edit-user/{id}', ['as' => 'edit-user', 'uses' => 'Admin\AdminController@editUser']);
            Route::match(['get', 'post'], 'user/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\AdminController@ajaxAction']);

            Route::match(['get', 'post'], '/admin/system-user-list', ['as' => 'system-user-list', 'uses' => 'Admin\SystemuserController@getUserData']);
            Route::match(['get', 'post'], '/admin/system-add-user', ['as' => 'system-add-user', 'uses' => 'Admin\SystemuserController@addUser']);
            Route::match(['get', 'post'], '/admin/system-edit-user/{id}', ['as' => 'system-edit-user', 'uses' => 'Admin\SystemuserController@editUser']);

            Route::match(['get', 'post'], '/admin/customer-list', ['as' => 'customer-list', 'uses' => 'Admin\CustomerController@getCustomerData']);
            Route::match(['get', 'post'], '/admin/customer-add', ['as' => 'customer-add', 'uses' => 'Admin\CustomerController@addCustomer']);
            Route::match(['get', 'post'], '/admin/customer-edit/{id}', ['as' => 'customer-edit', 'uses' => 'Admin\CustomerController@editCustomer']);

            Route::match(['get', 'post'], '/admin/product-list', ['as' => 'product-list', 'uses' => 'Admin\ProductController@getProdctList']);
            Route::match(['get', 'post'], '/admin/product-add', ['as' => 'product-add', 'uses' => 'Admin\ProductController@addProduct']);
            Route::match(['get', 'post'], '/admin/product-edit/{id}', ['as' => 'product-edit', 'uses' => 'Admin\ProductController@editProduct']);
            Route::match(['get', 'post'], '/admin/product/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\ProductController@ajaxAction']);

            /* Timesheet routes */
            /* Workplaces route */

            Route::match(['get', 'post'], '/admin/workplaces-list', ['as' => 'workplaces-list', 'uses' => 'Admin\WorkplacesController@getWorkplacesList']);
            Route::match(['get', 'post'], '/admin/workplaces-add', ['as' => 'workplaces-add', 'uses' => 'Admin\WorkplacesController@addWorkplaces']);
            Route::match(['get', 'post'], '/admin/workplaces-edit/{id}', ['as' => 'workplaces-edit', 'uses' => 'Admin\WorkplacesController@editWorkplaces']);
            Route::match(['get', 'post'], '/admin/workplaces/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\WorkplacesController@ajaxAction']);
            Route::match(['get', 'post'], '/admin/workplaces/ajaxActions', ['as' => 'ajaxActions', 'uses' => 'Admin\WorkplacesController@ajaxActions']);
            Route::match(['get', 'post'], '/admin/workplaces-list/delWorkplaces', ['as' => 'delWorkplaces', 'uses' => 'Admin\WorkplacesController@delWorkplaces']);

            /* Worker route */

            Route::match(['get', 'post'], '/admin/worker-list', ['as' => 'worker-list', 'uses' => 'Admin\WorkerController@getWorkerList']);
            Route::match(['get', 'post'], '/admin/worker-add', ['as' => 'worker-add', 'uses' => 'Admin\WorkerController@addWorker']);
            Route::match(['get', 'post'], '/admin/worker-edit/{id}', ['as' => 'worker-edit', 'uses' => 'Admin\WorkerController@editWorker']);
            Route::match(['get', 'post'], '/admin/worker/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\WorkerController@ajaxAction']);
            Route::match(['get', 'post'], '/admin/worker-list-search', ['as' => 'worker-list-search', 'uses' => 'Admin\WorkerController@getWorkerListsearch']);

            /* Timesheet route */

            Route::match(['get', 'post'], '/admin/timesheet-list', ['as' => 'timesheet-list', 'uses' => 'Admin\TimesheetController@getTimesheetList']);
            Route::match(['get', 'post'], '/admin/timesheet-list-search', ['as' => 'timesheet-list-search', 'uses' => 'Admin\TimesheetController@getTimesheetListsearch']);
            Route::match(['get', 'post'], '/admin/timesheet-edit/{id}', ['as' => 'timesheet-edit', 'uses' => 'Admin\TimesheetController@editTimesheet']);
            Route::match(['get', 'post'], '/admin/timesheet/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\TimesheetController@ajaxAction']);

            /* Information route */

            Route::match(['get', 'post'], '/admin/information-list', ['as' => 'information-list', 'uses' => 'Admin\InformationController@getInformationList']);
            Route::match(['get', 'post'], '/admin/information-list-search', ['as' => 'information-list-search', 'uses' => 'Admin\InformationController@getInformationListsearch']);

            /* Profile route */

            Route::match(['get', 'post'], 'update-profile', ['as' => 'update-profile', 'uses' => 'Admin\UpdateProfileController@editProfile']);
            Route::match(['get', 'post'], 'update-change-password', ['as' => 'update-change-password', 'uses' => 'Admin\UpdateProfileController@changepassword']);
        });



