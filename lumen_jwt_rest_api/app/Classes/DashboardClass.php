<?php

namespace App\Classes;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class DashboardClass
{
    private $task,$project;
    public function __construct(Project $project,Task $task)
    {
        $this->task = $task;
        $this->project = $project;
    }
    public function getDashboard(){
        try {
            return "Hii";
        }catch (\Exception $ex){
            Log::info("DashboardClass Error",["getDashboard"=>$ex->getMessage(),"line"=>$ex->getLine()]);
            return response()->json(["status"=>false,"message"=>"internal server Error"])->setStatusCode(500);
        }
    }
}
