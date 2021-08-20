<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\OrderInfo;
use App\Model\Worker;
use PDF;

class Users extends Model {

    protected $table = 'users';
    
    public function gtUsrLlist($id = NULL) {
        if($id){
            $result = Users::select('users.*')
                        ->where('users.id', '=', $id)
                        ->get();
            
        }else{
            $result = Users::get();

           // dd($result);
        }
        
        return $result;
    }

    public function gtBeststafflist($id = NULL) {
        if($id){
            $result = Users::get();
            
        }else{
            $result = worker::select('users.id','users.staffnumber','users.name','users.surname',
                            DB::raw('SUM(total_time) as total_houres')
                        )
                        ->join('timesheet','users.id','=','timesheet.worker_id')
                        ->groupBy('timesheet.worker_id')
                        ->get();
        }
        
        return $result;
    }

    public function saveUserInfo($request) {

        $newpassword = ($request->input('password') != '') ? $request->input('password') : null;
        $newpass = Hash::make($newpassword);
        $objUser = new Users();
        $objUser->name = $request->input('first_name');
        $objUser->email = $request->input('email');
        $objUser->type = '0';
//        $objUser->role_type = $request->input('role_type');
        $objUser->password = $newpass;
        $objUser->created_at = date('Y-m-d H:i:s');
        $objUser->updated_at = date('Y-m-d H:i:s');
        $objUser->save();
        return TRUE;
    }

    public function savetimesheetWorkerInfo($request) {
        
        $date=date('Y-m-d',  strtotime($request->input()['select_date']));
        $objUser = new timesheet();
        $users = timesheet::where('c_date','=',$date)
                ->where('worker_id','=',$request->input('worker_id'))
                ->count();
    
        if($users>0){
            return "dateAdded";
        }else{
        $objUser->worker_id = $request->input('worker_id');
        $objUser->c_date = $date;
        $objUser->workplaces = $request->input('workplaces');
        $objUser->start_time = $request->input('start_time');
        $objUser->end_time = $request->input('end_time');
        $objUser->pause_time = $request->input('pause_time');
        $objUser->reason = $request->input('reason');
        
        $working_time = (new Carbon($objUser->end_time))->diff(new Carbon($objUser->start_time))->format('%h:%I');
        $total_time=(new Carbon($working_time))->diff(new Carbon($objUser->pause_time))->format('%h:%I');
        $pause_times = (new Carbon(date($objUser->pause_time)))->format('h:i:s');


        //$main_total_time = (new Carbon($pause_times))->diff(new Carbon($total_time))->format('%h:%I');

        $policy_times = "09:00";
        $policy_total_time = (new Carbon($policy_times))->diff(new Carbon($total_time))->format('%h:%I');

        $objUser->missing_hour = $policy_total_time;
        $objUser->total_time = $total_time;

        $objUser->created_at = date('Y-m-d H:i:s');
        $objUser->updated_at = date('Y-m-d H:i:s');
        $objUser->save();
        
        return "Added";
        }
    }

    public function updateUserInfo($request) {
        //print_r($request->input('user_id'));
        $userId = $request->input('user_id');
        $objUser = Users::find($userId);
        $objUser->name = $request->input('first_name');
        $objUser->type = '0';
        $objUser->updated_at = date('Y-m-d H:i:s');
        $objUser->save();
        return TRUE;
    }

    public function saveEditUserInfo($request) {
        $userId = $request->input('id');
        $objUser = Users::find($userId);
        $objUser->name = $request->input('name');
        $objUser->surname = $request->input('surname');

        if ($objUser->save()) {
            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function saveEditUserPassword($id, $password) {
        return Users::where('id', '=', $id)->update(['password' => Hash::make($password)]);
    }

    public function getUserId(){
        $result = Users::get();
        return $result;
    }
    
     public function getStaff() {
        $result = Users::pluck('name', 'id')->toArray();
        return $result;
    }
     public function getDashboradStaff() {
        $result = Users::where('type', '!=', 'ADMIN')->pluck('name', 'id')->toArray();
        
        return $result;
    }
	
	/*code by dhaval*/
	public function UpdatelastLogin($id)
	{
		return Users::where('id', '=', $id)->update(['last_login' => date('Y-m-d')]);
	}
	
	public function GetUserByStaffNumber($staff_number)
	{
		$result = Users::where('staffnumber', '=', $staff_number)->pluck('name', 'id')->toArray();
        
        return $result;
		
	}
	/*code by dhaval*/
}
