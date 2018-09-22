<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use DB;
use Auth;

class timesheet extends Model {

    protected $table = 'timesheet';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;

    public function getTimesheetList($id = NULL) {

        if($id){
            $result = timesheet::select('timesheet.*')
                        ->where('timesheet.worker_id', '=', $id)
                        ->get();
            //dd($result);
            
        }else{

            //$result = timesheet::get();
            

            $result = timesheet::select('timesheet.*','users.staffnumber')
                        ->join('users','timesheet.worker_id','=','users.id')
                        ->get();

            //dd($result);
        }
        
        return $result;
    }
	
	public function searchtimesheetInfo($request, $id = NULL) {

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
        ->get();*/


        $result = timesheet::select('timesheet.*','users.staffnumber','users.name');
        if($name != ""){
            $result->where('worker_id', 'LIKE', '%'.$name.'%');
        }
        if($workplaces != ""){
            $result->where('timesheet.workplaces', 'LIKE', '%'.$workplaces.'%');
        }
        if($toDate != ""){
            $result->whereRaw("c_date >= ? AND c_date <= ?", 
                array($fromDate." 00:00:00", $toDate." 23:59:59")
            );
        }
        
        $results =  $result->join('users','timesheet.worker_id','=','users.id')->get();


        //dd($results);

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
        ->get();*/


        $result = timesheet::select();
        if($name != ""){
            $result->where('worker_id', 'LIKE', '%'.$name.'%');
        }
        if($workplaces != ""){
            $result->where('timesheet.workplaces', 'LIKE', '%'.$workplaces.'%');
        }
        if($toDate != ""){
            $result->whereRaw("c_date >= ? AND c_date <= ?", 
                array($fromDate." 00:00:00", $toDate." 23:59:59")
            );
        }
        
        $results =  $result->get();


        

        return $results;
    }
	
}
