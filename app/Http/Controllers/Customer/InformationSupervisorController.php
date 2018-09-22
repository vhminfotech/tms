<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Model\Information;

class InformationSupervisorController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->middleware('customer');
    }

    public function dashboard() {
        $objInformation = new Information();
        $objinformationList = $objInformation->getTimesheetList();
        $data['arrInformation'] = $objinformationList;
        $data['detail'] = $this->loginUser; 
        return view('supervisor.information-list', $data);
    }
    
}
