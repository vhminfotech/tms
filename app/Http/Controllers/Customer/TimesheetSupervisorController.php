<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Timesheet;
use App\Model\Information;
use App\Http\Controllers\Controller;

class TimesheetSupervisorController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->middleware('customer');
    }

    public function dashboard(Request $request) {
        
            $data['detail'] = $this->loginUser; 
            $objWorkplaces = new Workplaces();
            $workplacesList = $objWorkplaces->getWorkplacesList();
            $data['arrWorkplaces'] = $workplacesList;

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;


            $objTimesheet = new Timesheet();
            $timesheetList = $objTimesheet->getTimesheetList();
            $data['arrTimesheet'] = $timesheetList;

        if ($request->isMethod('post')) {
            /*print_r($request->input());
            exit;*/
            $workertimesheetList = $objUser->savetimesheetWorkerInfo($request); 
            
            if ($workertimesheetList=="Added") {
                $return['status'] = 'success';
                $return['message'] = 'Date and time created successfully.';
                $return['redirect'] =  route('worker-dashboard');
            } else {
                if($workertimesheetList=='dateAdded'){
                    $return['status'] = 'error';
                    $return['message'] = '2 objects same time not possible.';
                    $return['redirect'] =  route('worker-dashboard');
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
    public function timesheet_list(Request $request) {
        $data['serchlist']=['','','',''];
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;
        
        $objTimesheet = new Timesheet();
        $total_time = $objTimesheet->gettotaltime();
        $data['total_time'] = $total_time;
        
        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.listInit()');
     
        $data['arrTimesheet'] = $timesheetList;
        
        $data['detail'] = $this->loginUser;

         if ($request->isMethod('post')) {
            $objTimesheet = new Timesheet();
            $timesheetsearchList = $objTimesheet->searchtimesheetInfo($request); 
            $data['arrTimesheet'] = $timesheetsearchList;
         }
        return view('supervisor.timesheet_list', $data);
    }
    public function getsearchTimesheetList(Request $request) {
        $input=$request->input();
        $data['serchlist']=[$input['name'],$input['workplaces'],$input['start_date'],$input['end_date']];
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;
        
        $objTimesheet = new Timesheet();
        $total_time = $objTimesheet->gettotaltime($request);
        $data['total_time'] = $total_time;
        
        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.listInit()');
     
        $data['arrTimesheet'] = $timesheetList;
        $data['detail'] = $this->loginUser;

         if ($request->isMethod('post')) {
            $objTimesheet = new Timesheet();
            $timesheetsearchList = $objTimesheet->searchtimesheetInfo($request); 
            $data['arrTimesheet'] = $timesheetsearchList;
         }
        return view('supervisor.timesheet_list', $data);
    }

    public function getsearchInformationList(Request $request) {
            $input=$request->input();
            $data['serchlist']=[$input['name'],$input['workplaces'],$input['start_date'],$input['end_date']];
            $data['detail'] = $this->loginUser; 

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrUser'] = $userList;

            $objWorkplaces = new Workplaces();
            $workplacesList = $objWorkplaces->getWorkplacesList();
            $data['arrWorkplaces'] = $workplacesList;

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;


            $objTimesheet = new Timesheet();
            $timesheetList = $objTimesheet->getTimesheetList();
            $data['arrTimesheet'] = $timesheetList;

         if ($request->isMethod('post')) {
            $objTimesheet = new Information();
            $timesheetsearchList = $objTimesheet->searchinformationInfo($request); 
            $data['arrInformation'] = $timesheetsearchList;
         }
        return view('supervisor.information-list', $data);
    }

    public function getdassearchList(Request $request) {
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.listInit()');
     
        $data['arrTimesheet'] = $timesheetList;
        $data['detail'] = $this->loginUser;

         if ($request->isMethod('post')) {
            $objTimesheet = new Timesheet();
            $timesheetsearchList = $objTimesheet->searchtimesheetInfo($request); 
            $data['arrTimesheet'] = $timesheetsearchList;
         }
        return view('supervisor.dash-search-list', $data);

    }

    public function getdassearchInformationList(Request $request) {
            
            $data['dates']=[$request->input()['start_date'],$request->input()['end_date']];
            $data['detail'] = $this->loginUser; 
            $user_id = $this->loginUser['id'];
            $user = Users::find($user_id);
           

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrUser'] = $userList;

            $objWorkplaces = new Workplaces();
            $workplacesList = $objWorkplaces->getWorkplacesList();
            $data['arrWorkplaces'] = $user['workplaces'];
    
            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;


            $objTimesheet = new Timesheet();
            $timesheetList = $objTimesheet->getTimesheetList();
            $data['arrTimesheet'] = $timesheetList;

         if ($request->isMethod('post')) {
            $objTimesheet = new Information();
            $timesheetsearchList = $objTimesheet->search_date_workerInfo($request); 
            $data['arrTimesheet'] = $timesheetsearchList;
         }
        return view('supervisor.dashboard', $data);
    }
    
}