<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Worker;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class AdminController extends Controller {
            
    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
        //$this->middleware('guest:admin', ['except' => ['subDashboard']]);
        //$this->middleware('guest:subadmin', ['except' => ['mainDashboard', 'subDashboard']]);
    }

    public function dashboard(Request $request) {

        $data['detail'] = $this->loginUser;
        $objUser = new Users();
        $userList = $objUser->gtBeststafflist();
        $data['arrBeststaff'] = $userList;
         $data['js'] = array('admin/customer.js');
        return view('admin.dashboard', $data);

    }

    public function getUserData() {

        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/customer.js');
        $data['funinit'] = array('Customer.listInit()');
        $data['arrUser'] = $userList;
        $data['detail'] = $this->loginUser;
        return view('admin.user.user-list', $data);
    }

    public function addUser(Request $request) {
        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
//            print_r($request->input());exit;
            $objUser = new Users();
            $userList = $objUser->saveUserInfo($request);
            if ($userList) {
                $return['status'] = 'success';
                $return['message'] = 'User created successfully.';
                $return['jscode'] = 'setTimeout(function(){location.reload();},1000)';
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/customer.js');
        $data['funinit'] = array('Customer.addInit()');


        return view('admin.user.add-user', $data);
    }

    public function editUser($userId, Request $request) {
        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
//            print_r($request->input());exit;
            $objUser = new Users();
            $userList = $objUser->updateUserInfo($request);
            if ($userList) {
                $return['status'] = 'success';
                $return['message'] = 'User Edit successfully.';
                $return['redirect'] = route('user-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/customer.js');
        $data['funinit'] = array('Customer.editInit()');

        $objMuck = new Users();
        $muckDetail = $objMuck->gtUsrLlist($userId);
        $data['userDetail'] = $muckDetail;

        return view('admin.user.edit-user', $data);
    }

    public function deleteUser($postData) {
        $result = Users::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'User Delete successfully.';
            $return['redirect'] = route('user-list');
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
            case 'deleteUser':
                $result = $this->deleteUser($request->input('data'));
                break;
        }
    }

}