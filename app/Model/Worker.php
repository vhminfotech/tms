<?php

namespace App\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use DB;
use Auth;

class Worker extends Model {

    protected $table = 'users';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;

    public function timesheet()
   {
      return $this->hasMany('App\Model\Timesheet');
   }

    public function getWorkerList($id = NULL) {

         //$results = worker::with('timesheet')->get();
        // $result = worker::with('timesheet')->get();
        
        if($id){
            $result = worker::select('users.*')
                        ->where('users.id', '=', $id)
                        ->get();
            
        }else{
            /*$result = worker::select('users.id','users.staffnumber','users.name','users.surname','timesheet.start_time','timesheet.pause_time',DB::raw('SUM(total_time) as total_houres'))
                        ->join('timesheet','users.id','=','timesheet.worker_id')
                        ->groupBy('users.id')
                        ->get();
*/
                            $result = worker::select('users.id','users.staffnumber','users.name','users.surname',
                            DB::raw('SUM(pause_time) as pause_houres'),
                            DB::raw('SUM(total_time) as total_houres'),
                            DB::raw('c_date as c_dates')
                        )
                        ->join('timesheet','users.id','=','timesheet.worker_id')
                        ->groupBy('users.id')
                        ->get();
 
        }
        
        return $result;
    }
	
	public function saveWorkerInfo($request) {

        $newpassword = ($request->input('password') != '') ? $request->input('password') : null;
        $newpass = Hash::make($newpassword);
        
        $objWorker = new worker();
        $objWorker->name = $request->input('name');
        $objWorker->surname = $request->input('surname');
        $objWorker->staffnumber = $request->input('staffnumber');
        $objWorker->password = $newpass;
        $objWorker->created_at = date('Y-m-d H:i:s');
        $objWorker->updated_at = date('Y-m-d H:i:s');
        $objWorker->type = $request->input('type');
        $workplaces = $request->input('workplaces');
        $objWorker->workplaces = implode(',', $workplaces);
        $objWorker->remember_token = Str::random(60);

        $objWorker->save();
        return TRUE;
    }

    public function updateWorkerInfo($request) {

        $workerId = $request->input('id');
        $objWorker = worker::find($workerId);
        $objWorker->name = $request->input('name');
        $objWorker->surname = $request->input('surname');
        $objWorker->staffnumber = $request->input('staffnumber');
        $objWorker->type = $request->input('type');
        $workplaces = $request->input('workplaces');
        $objWorker->workplaces = implode(',', $workplaces);
        $objWorker->created_at = date('Y-m-d H:i:s');
        $objWorker->updated_at = date('Y-m-d H:i:s');

       /* echo $workerId;
        exit;*/
        
        $objWorker->save();
        return TRUE;
    }

     public function searchworkerInfo($request, $id = NULL) {
        
        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');


        $result = timesheet::select('timesheet.*','users.staffnumber','users.name','users.surname');
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

        //dd($results);
        

        return $results;
    }

	
}
