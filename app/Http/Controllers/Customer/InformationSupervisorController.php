<?php

namespace App\Http\Controllers\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Information;
use App\Model\Users;
use App\Model\Workplaces;

class InformationSupervisorController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->middleware('customer');
    }

    public function dashboard() {
        $data['serchlist']=['','','',''];
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;
        
        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;
        
        $objInformation = new Information();
        $objinformationList = $objInformation->getTimesheetList();
        $data['arrInformation'] = $objinformationList;
        $data['detail'] = $this->loginUser; 
        return view('supervisor.information-list', $data);
    }
    
    public function informationsupervisoeredit(Request $request,$id=''){
        
         $data['detail'] = $this->loginUser; 
         
        if ($request->isMethod('post')) {
           $objInformation = new Information();
           $saveinformation=$objInformation->editinformation($request);
            
           if($saveinformation) {
                $return['status'] = 'success';
                $return['message'] = 'Information edit successfully.';
                $return['redirect'] = route('information_supervisor');
            }else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        
        $objInformation = new Information();
        $data['objinformationreason'] = $objInformation->getInformation($id);
        $data['id']=$id;
        
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('superviseor/superviseor.js');
        $data['funinit'] = array('Superviseor.editInit()');
        return view('supervisor.worker-edit-information', $data);
    }
    
}
