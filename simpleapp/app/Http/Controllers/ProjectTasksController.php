<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Project;

class ProjectTasksController extends Controller
{

    public function update(Task $task)
    {
        $task->update([
            'completed' => request()->has('completed')
        ]);
        return back();
    }

    public function store(Project $project)
    {
       $validatedAttributes= request()->validate(['description'=>'required']);
     //There are two methods to do this since we are adding task to a project we can do this in projects controller or here

//        Task::create([
//            'project_id' => $project->id,
//                'description' =>request('description')
//        ]);

        //Method 2
//this function is in the projects model
   //     $project->addTask(request('description'));




       $project->addTask($validatedAttributes);


        return back();
    }
}
