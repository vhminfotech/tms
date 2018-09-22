<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use DB;
use Auth;

class information extends Model {

    protected $table = 'timesheet';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;

    public function getTimesheetList($id = NULL) {
        if($id){
            $result = timesheet::select('timesheet.*')
                        ->where('timesheet.id', '=', $id)
                        ->get(); 
        }else{
            $result = timesheet::select('timesheet.*','users.staffnumber','users.name')
                        ->join('users','timesheet.worker_id','=','users.id')
                        ->get(); 
        }
        
        return $result;
    }
    public function searchinformationInfo($request, $id = NULL) {
        
        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');


        $result = timesheet::select('timesheet.*','users.staffnumber','users.name');
        /*if($name != ""){
            $result->where('worker_id', 'LIKE', '%'.$name.'%');
        }
        if($workplaces != ""){
            $result->where('timesheet.workplaces', 'LIKE', '%'.$workplaces.'%');
        }*/
        if($toDate != ""){
            $result->whereRaw("c_date >= ? AND c_date <= ?", 
                array($fromDate." 00:00:00", $toDate." 23:59:59")
            );
        }
        
        $results =  $result->join('users','timesheet.worker_id','=','users.id')->get();


        

        return $results;
    }

    public function search_date_workerInfo($request, $id = NULL) {        
        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');
        $user_id =  $request->input('worker_id');

        $result = timesheet::select();
        /*if($name != ""){
            $result->where('worker_id', 'LIKE', '%'.$name.'%');
        }
        if($workplaces != ""){
            $result->where('timesheet.workplaces', 'LIKE', '%'.$workplaces.'%');
        }*/
        if($toDate != ""){
            $result->whereRaw("c_date >= ? AND c_date <= ?", 
                array($fromDate." 00:00:00", $toDate." 23:59:59")
            );
        }
        $results =  $result->where('timesheet.worker_id', '=', $user_id);
        $results =  $result->get();

        //dd($results);

        return $results;
    }

        
}
