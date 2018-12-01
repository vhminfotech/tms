<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Timesheet;
use App\Http\Controllers\Controller;

class CustomerController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->middleware('customer');
    }

    public function dashboard(Request $request) {
        
            $data['detail'] = $this->loginUser;
            $user_id = $this->loginUser['id'];
            $user = Users::find($user_id);

            $data['arrWorkplaces'] = $user['workplaces'];

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;


            $objTimesheet = new Timesheet();
            $timesheetList = $objTimesheet->getTimesheetList($user_id);
            $data['arrTimesheet'] = $timesheetList;
            
            $data['totaltime'] = $objTimesheet->getTotallTime($user_id);
           
        if ($request->isMethod('post')) {
            /*print_r($request->input());
            exit;*/
            $workertimesheetList = $objUser->savetimesheetWorkerInfo($request); 
            
            
            if ($workertimesheetList=="Added") {
                $return['status'] = 'success';
                $return['message'] = 'Date and time created successfully.';
                $return['redirect'] =  route('customer-dashboard');
            } else {
                if($workertimesheetList=='dateAdded'){
                    $return['status'] = 'error';
                    $return['message'] = '2 objects same time not possible.';
                    $return['redirect'] =  route('customer-dashboard');
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js');
        $data['funinit'] = array('TWorker.addInit()');
        return view('supervisor.dashboard', $data);
    }    
}