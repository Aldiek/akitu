<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

class TaskTimeController extends Controller
{
        public function index($id) {
            
         $taskSel=Task::where('user_id',$id)->get();
         $userID= $id;
         if($taskSel== null){
                $taskSel = new Task();
                $taskSel->rating = 0;
                $taskSel->status= 0;
                $taskSel->user_id= $id;
                $taskSel->task_date= Carbon::now()->toDateTimeString();
               
         }
         return view('admin.task-time', ['taskSel' => $taskSel,'userID'=>$userID]);

        }


        public function updateTask($id) {

         $taskSel=Task::where('user_id',$id)->first();
         if($taskSel== null){
                $taskSel = new Task();
                $taskSel->rating = 0;
                $taskSel->status= 0;
                $taskSel->user_id= $id;
                $taskSel->task_date= Carbon::now()->toDateTimeString();
         }
         else{
                $taskSel->rating = (request()->star == null) ? 0 : request()->star ;
                $taskSel->status= request()->status;
                $taskSel->user_id= $id;
                $taskSel->task_date= request()->datee;

         }
                $taskSel->save();
                session()->flash("message", "Task has been insert successfully!");
                return redirect()->back();

        }


        public function taskShow() {

       $taskTim=Task::where('user_id',auth()->user()->id)->first();

         return view('user.task-show', ['taskTim' => $taskTim]);
            
        }
}
