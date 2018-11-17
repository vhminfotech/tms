<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Timesheet;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Illuminate\Http\Request;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class TimesheetController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
        //$this->middleware('guest:admin', ['except' => ['subDashboard']]);
        //$this->middleware('guest:subadmin', ['except' => ['mainDashboard', 'subDashboard']]);
    }

    public function getTimesheetList() {

        $data['detail'] = $this->loginUser;
        
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;
        
        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        
        $total_time = $objTimesheet->gettotaltime();
        $data['total_time'] = $total_time;
        
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.listInit()');
     
        $data['arrTimesheet'] = $timesheetList;
        
        return view('admin.timesheet.timesheet-list', $data);
    }

    public function getTimesheetListsearch(Request $request) {
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
        return view('admin.timesheet.timesheet-list', $data);
    }

    public function getTimesheetmodeldata() {

        $data['detail'] = $this->loginUser;
        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['arrTimesheet'] = $timesheetList;
        return view('admin.timesheet.timesheet-add', $data);
    }


	/*public function addTimesheet(Request $request) {

        $data['detail'] = $this->loginUser;
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['arrTimesheet'] = $timesheetList;

        if ($request->isMethod('post')) {
             //print_r($request->input());exit;
            $timesheetList = $objTimesheet->saveTimesheetInfo($request); 
            if ($timesheetList) {
                $return['status'] = 'success';
                $return['message'] = 'Date & Time created successfully.';
                $return['redirect'] =  route('timesheet-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.addInit()');
        return view('admin.timesheet.timesheet-add', $data);
    }*/

     public function editTimesheet($timesheetId , Request $request) {
        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
//            print_r($request->input());exit;
            $objWorkplaces = new Timesheet();
            $objWorkplacesList = $objWorkplaces->updateTimesheetAdmin($request,$timesheetId);
            if ($objWorkplacesList) {
                $return['status'] = 'success';
                $return['message'] = 'Update Timesheet successfully.';
                $return['redirect'] =  route('timesheet-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.editInit()');
        
        $objMuck = new Timesheet();
        $muckDetail = $objMuck->getTimesheetListAdmin($timesheetId);
        $data['timesheetDetail'] = $muckDetail;
        
        return view('admin.timesheet.timesheet-edit', $data);
    }
   
    public function deleteTimesheet($postData) {
        $result = Timesheet::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Date & Time Delete successfully.';
            $return['redirect'] = route('timesheet-list');
        } else {
            $return['status'] = 'error';
            $return['message'] = 'something will be wrong.';
        }
        echo json_encode($return);
        exit;
    }
    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'deleteTimesheet':
                $result = $this->deleteTimesheet($request->input('data'));
                break;
        }
    }

}