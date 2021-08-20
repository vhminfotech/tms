<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use DB;
use Auth;

class Timesheet extends Model {

    protected $table = 'timesheet';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;

    public function getTimesheetList($id = NULL) {
        if ($id) {
            $result = timesheet::select('timesheet.*')
                    ->where('timesheet.worker_id', '=', $id)
                    ->get();
        } else {
            $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id')
                    ->get();
        }
        return $result;
    }
    
    public function getTotallTime($id,$dates = NULL){
        if($dates){
            $start_date=date('Y-m-d', strtotime($dates['0']));
            $end_date=date('Y-m-d', strtotime($dates['1']));
           
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where worker_id ='" .$id."' AND c_date >='".$start_date."' AND c_date <='".$end_date."'";
            $result=DB::select(DB::raw($qurey)); 
           
        }else{
         $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where worker_id =" .$id;
         $result=DB::select(DB::raw($qurey)); 
        }
         return $result[0]->timeSum;
       
    }

        public function gettotaltime($request = NULL){
        if($request){
          
            $useId=$request->input()['name'];
            $workplace=$request->input()['workplaces'];
            $start_date=date('Y-m-d',  strtotime($request->input()['start_date']));
            $end_date=date('Y-m-d',  strtotime($request->input()['end_date']));
            
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where worker_id='".$useId."' AND workplaces='".$workplace."'AND c_date >='".$start_date."' AND c_date <='".$end_date."'";
            if($useId == "" && $workplace == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet ";
            }else{
                if($useId==""){
                    $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$workplace."'AND c_date >='".$start_date."' AND c_date <='".$end_date."'";
                } 
                if($workplace==""){
                    $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$useId."'AND c_date >='".$start_date."' AND c_date <='".$end_date."'";
                }
            }
            
           
            $result=DB::select(DB::raw($qurey));
           
//            $result = timesheet::sum('total_time')
//                        ->where('users.worker_id', '=', $id);
        }else{
            
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet";
            $result=DB::select(DB::raw($qurey));
          
        }
       
        return $result[0]->timeSum;
        
    }
    
    public function getTimesheetListAdmin($id) {
       
            $result = timesheet::select('timesheet.*')
                    ->where('timesheet.id', '=', $id)
                    ->get();
        
        return $result;
    }

    public function searchtimesheetInfo($request, $id = NULL) {

        $name = $request->input()['name'];
        $workplaces = $request->input()['workplaces'];
        $fromDate = date("Y-m-d", strtotime($request->input()['start_date']));
        $toDate = date("Y-m-d",  strtotime($request->input()['end_date']));
        
        $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id');
         if ($name != "") {
            $result->where('worker_id', 'LIKE', '%' . $name . '%');
        }
        if ($workplaces != "") {
            $result->where('timesheet.workplaces', 'LIKE', '%' . $workplaces . '%');
        }
        $result->where('c_date','>=',$fromDate);
        $result->where('c_date','<=',$toDate);
        $results=$result->get();
        
        return $results;
    }

    public function searchinformationInfo($request, $id = NULL) {

        $name = $request->input('name');
        $workplaces = $request->input('workplaces');
        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');
        /*
          $result = timesheet::whereRaw("c_date >= ? AND c_date <= ?",
          array($fromDate." 00:00:00", $toDate." 23:59:59")
          )
          ->where('timesheet.worker_id', '=', $name)
          ->where('timesheet.workplaces', '=', $workplaces)
          ->get(); */


        $result = timesheet::select();
        if ($name != "") {
            $result->where('worker_id', 'LIKE', '%' . $name . '%');
        }
        if ($workplaces != "") {
            $result->where('timesheet.workplaces', 'LIKE', '%' . $workplaces . '%');
        }
        if ($toDate != "") {
            $result->whereRaw("c_date >= ? AND c_date <= ?", array($fromDate . " 00:00:00", $toDate . " 23:59:59")
            );
        }

        $results = $result->get();
        return $results;
    }

    public function getBestStaffData($postData) {

        $month = $postData['months'];
        $year = $postData['year'];
        $sql = timesheet::select('timesheet.*', 'users.name', 'users.staffnumber', DB::raw("SUM(timesheet.total_time) as totalTime"))
                ->join('users', 'timesheet.worker_id', '=', 'users.id')
                ->groupBy('timesheet.worker_id');
        if (!empty($year) && empty($month)) {
            $sql->where(function($sql) use($year) {
                        $sql->orWhere(function($sql) use($year) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-01-01'), date($year . '-12-31')]);
                                });
                    });
        } if (!empty($year) && !empty($month)) {
            $sql->where(function($sql) use($year, $month) {
                        $sql->orWhere(function($sql) use($year, $month) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-' . $month . '-01'), date($year . '-' . $month . '-31')]);
                                });
                    });
        }
        $sql->orderBy(DB::raw("SUM(timesheet.total_time)"), 'desc');
        $result = $sql->first();

        return $result;
    }
    
    public function getRestWorkplace($postData) {

        $month = $postData['months'];
        $year = $postData['year'];
        $sql = timesheet::select('timesheet.*', 'workplaces.adresses', DB::raw("SUM(timesheet.total_time) as totalTime"))
                ->join('workplaces', 'workplaces.company', '=', 'timesheet.workplaces')
                ->groupBy('timesheet.workplaces');
        if (!empty($year) && empty($month)) {
            $sql->where(function($sql) use($year) {
                        $sql->orWhere(function($sql) use($year) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-01-01'), date($year . '-12-31')]);
                                });
                    });
        } if (!empty($year) && !empty($month)) {
            $sql->where(function($sql) use($year, $month) {
                        $sql->orWhere(function($sql) use($year, $month) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-' . $month . '-01'), date($year . '-' . $month . '-31')]);
                                });
                    });
        }
        $sql->orderBy(DB::raw("SUM(timesheet.total_time)"), 'desc');
        $result = $sql->first();
//echo '<pre/>';print_r($result);exit;
        return $result;
    }
    
    public function getWorkplaceListData($postData) {
//        print_r($postData);exit;
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['name'];
        $sql = timesheet::select('timesheet.*','users.name','users.surname', 'workplaces.adresses')
                ->join('users', 'timesheet.worker_id', '=', 'users.id')
                ->join('workplaces', 'workplaces.company', '=', 'timesheet.workplaces');
            $sql->where('timesheet.workplaces', $staffId);
        if (!empty($year) && empty($month)) {
            $sql->where(function($sql) use($year) {
                        $sql->orWhere(function($sql) use($year) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-01-01'), date($year . '-12-31')]);
                                });
                    });
        } 
        if (!empty($year) && !empty($month)) {
            $sql->where(function($sql) use($year, $month) {
                        $sql->orWhere(function($sql) use($year, $month) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-' . $month . '-01'), date($year . '-' . $month . '-31')]);
                                });
                    });
        }
        $result = $sql->get()->toArray();
        
        return $result;
    }
    
    public function getWorkplaceTotalTime($postData){
        
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['name'];
        if (!empty($year) && empty($month)) {
            $startdate=date($year . '-' . $month . '-01');
            $enddate=date($year . '-12-31');
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$staffId."' AND c_date BETWEEN '". $startdate ."'AND'". $enddate."'";
        }
        
         if (!empty($year) && !empty($month)) {
             $startdate=date($year . '-01-01');
             $enddate=date($year . '-' . $month . '-31');
             $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$staffId."' AND c_date BETWEEN '". $startdate ."'AND'". $enddate."'";
         }
         
          if (empty($year) && empty($month)) {
              $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$staffId."'";
          }
         
        $result=DB::select(DB::raw($qurey));
       
        return $result['0']->timeSum;
    }

    public function getStaffListData($postData) {
//        print_r($postData);exit;
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['staffId'];
        $sql = timesheet::select('timesheet.*','users.name','users.surname', 'workplaces.adresses')
                ->join('users', 'timesheet.worker_id', '=', 'users.id')
                ->join('workplaces', 'workplaces.company', '=', 'timesheet.workplaces');
            $sql->where('timesheet.worker_id', $staffId);
        if (!empty($year) && empty($month)) {
            $sql->where(function($sql) use($year) {
                        $sql->orWhere(function($sql) use($year) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-01-01'), date($year . '-12-31')]);
                                });
                    });
        } 
        if (!empty($year) && !empty($month)) {
            $sql->where(function($sql) use($year, $month) {
                        $sql->orWhere(function($sql) use($year, $month) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-' . $month . '-01'), date($year . '-' . $month . '-31')]);
                                });
                    });
        }
        $result = $sql->get()->toArray();
        return $result;
    }
    
    public function getStaffTotalTime($postData){
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['staffId'];
        
          if (!empty($year) && empty($month)) {
            $startdate=date($year . '-' . $month . '-01');
            $enddate=date($year . '-12-31');
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$staffId."' AND c_date BETWEEN '". $startdate ."'AND'". $enddate."'";
        }
        
         if (!empty($year) && !empty($month)) {
             $startdate=date($year . '-01-01');
             $enddate=date($year . '-' . $month . '-31');
             $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$staffId."' AND c_date BETWEEN '". $startdate ."'AND'". $enddate."'";
         }
         
          if (empty($year) && empty($month)) {
              $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$staffId."'";
          }
         
        $result=DB::select(DB::raw($qurey));
       
        return $result['0']->timeSum;
        
    }


    public function updateTimesheetAdmin($request,$timesheetId){
       
        $objTime = Timesheet::find($timesheetId);
        $objTime->start_time = $request->input('timesheet_edit_start_time');
        $objTime->end_time = $request->input('timesheet_edit_end_time');
        $objTime->pause_time = $request->input('timesheet_edit_push_time');
        
        $working_time = (new Carbon($objTime->end_time))->diff(new Carbon($objTime->start_time))->format('%h:%I');
        $total_time=(new Carbon($working_time))->diff(new Carbon($objTime->pause_time))->format('%h:%I');
        $pause_times = (new Carbon(date($objTime->pause_time)))->format('h:i:s');
        $information=$request->input('inforamtion');
        //$main_total_time = (new Carbon($pause_times))->diff(new Carbon($total_time))->format('%h:%I');

        $policy_times = "09:00";
        $policy_total_time = (new Carbon($policy_times))->diff(new Carbon($total_time))->format('%h:%I');

        $objTime->missing_hour = $policy_total_time;
        $objTime->total_time = $total_time;
        $objTime->reason = $information;
        $objTime->updated_at = date('Y-m-d H:i:s');
        $objTime->save();
        return TRUE;
    }
    
    public function gettotaltime_worker($id){
         $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$id."'";
         $result=DB::select(DB::raw($qurey));
         
         return $result['0']->timeSum;
         
    }
    
    public function gettotaltime_worker_serch($request){
        
        $start_date=date('Y-m-d',  strtotime($request->input('start_date')));
        $end_date=date('Y-m-d',  strtotime($request->input('end_date')));
        $worker_id=$request->input('worker_id');
        
        $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$worker_id."' AND c_date >='".$start_date."' AND c_date <='".$end_date."'";
      
         $result=DB::select(DB::raw($qurey));
         
         return $result['0']->timeSum;
        
    }
}
