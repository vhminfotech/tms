<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Information;
use App\Model\Timesheet;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Illuminate\Http\Request;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class InformationController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
        //$this->middleware('guest:admin', ['except' => ['subDashboard']]);
        //$this->middleware('guest:subadmin', ['except' => ['mainDashboard', 'subDashboard']]);
    }

    public function getInformationList() {
        
        $objInformation = new Information();
        $objinformationList = $objInformation->getTimesheetList();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/information.js');
        $data['funinit'] = array('Information.listInit()');
     
        $data['arrInformation'] = $objinformationList;
        $data['detail'] = $this->loginUser;

        $userid = new Users;
        $getUserId = $userid->getUserId();
        $data['getUserId'] = $getUserId;
        
        return view('admin.information.information-list', $data);
    }
  
    public function deleteInformation($postData) {
        $result = Timesheet::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Information Delete successfully.';
            $return['redirect'] = route('information-list');
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
            case 'deleteInformation':
                $result = $this->deleteInformation($request->input('data'));
                break;
        }
    }
    public function getInformationListsearch(Request $request) {

        $objInformation = new Information();
        $objinformationList = $objInformation->getTimesheetList();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/information.js');
        $data['funinit'] = array('Information.listInit()');
     
        $data['arrInformation'] = $objinformationList;
        $data['detail'] = $this->loginUser;

        $userid = new Users;
        $getUserId = $userid->getUserId();
        $data['getUserId'] = $getUserId;


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
            $objTimesheet = new Information();
            $timesheetsearchList = $objTimesheet->searchinformationInfo($request); 
            $data['arrInformation'] = $timesheetsearchList;
         }
        return view('admin.information.information-list', $data);
    }

}