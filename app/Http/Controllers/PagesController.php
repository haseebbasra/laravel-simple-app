<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Project;
use App\Mail\ProjectCreated;


class PagesController extends Controller
{

    public function __construct()
    {
      //This would need user to be authenticated for all the actions
        $this->middleware('auth');

        //for specific actions we can use this function
        // $this->middleware('auth')->only(['store','update']);

        // or
         // $this->middleware('auth')->except(['store','update']);
    }
    //All the methods defined in this controller, their routes are automatically created with the route keyword
    public static function Index()
    {
    

    //Instead of storing something in datavbase we can use cache to save our frequently used data 

   cache()->rememberForever('stats', function()
{
    return ['lessons'=>1300 , 'hours' => 50000, 'series' =>100];

});
        // auth->id(); //gives the user id who is logged in
        // auth->user(); //gives the user who is logged in
        // auth->check(); //returns boolean true or false based on user logged in or not
       // $projects= \App\Project::all();
        $projects= Project::where('owner_id',auth()->id())->get();


        return view('projects')->with([
            'projects'=> $projects,
        ]);
    }

    public function create()
    {
       return view('createproject');
    }

    public function store()
    {

//        $project = new project();
//        $project->title= request('title');
//        $project->description = request('description');
//        $project->save();

//We should validate our requests, by default this sends the errors array to the template if errors are there
      $validated=  request()->validate([
                'title' => ['required','min:3'],
                'description' => ['required','min:10'],

            ]
        );

      //Because we have done the validation and we already got the data to pass to create template in the validated variable
        //we can use that instead of writing complete code on line 48

        $validated['owner_id']=auth()->id();


       $project=  Project::create($validated);

        \Mail::to('haseebbasra1@gmail.com')->send(

            new ProjectCreated($project)
        );



       

        //We can change above code to this one also



//        Project::create([
//           'title' => request('title'),
//           'description' => request('description'),
//        ]);

        //We can also do this in this way if we have set the fillable items or guarded appropriately

   //    Project::create(request()->all());

        return redirect('/projects');


    }


//    public function show($id)
//    {
//
//        $project=Project::findOrFail($id);
//
//      return  view('showproject')->with(['project' => $project]);
//    }

//Notice the above commented function, that can also be used to return the data
//But here is the cool way to do that using wildcard, we can typehint it here in the function  read about laravel route model
//binding also to configure it as per requirements

    public function show(Project $project)
    {

        //we can also use laravel default function

        // abort_if($project->owner_id!=auth()->id(),403)

        //also we can use owns method but we have to add function 

      //   abort_if(auth()->user()->owns($project),403);

      // abort_unless(auth()->user()->owns($project),403);
    //   if($project->owner_id!=auth()->id())
    // {
    //   abort(403);
    // }

        //We can also use gates for this functionality

        // if(\Gate::denies('view',$project))
        // {
        //     abort(403);
        // }

       // Or we can use gate allows
    // abort_unless(\Gate::allows('view',$project),403);

        //We have used policies here for authorization,
       //  $this->authorize('view',$project);

        //The best way to do this thing is use can
      auth()->user()->can('view',$project);

    



//        $twitter= app('twitter');
//
//        dd($twitter);

      return  view('showproject')->with(['project' => $project]);
    }

    public function edit($id)  //example.com/projects/1/edit
    {
//return $id;

   //     $project=Project::find($id);
//find or fail is used to stop the program if something is not found
        $project=Project::findOrFail($id);
      return view ('editproject')->with(['project'=>$project]);
    }

    public function update(Project $project)
    {

    //    $project= Project::find($id);
        //find or fail is used to stop the program if something is not found

        $project->title = request('title');
        $project->description= request('description');

        $project->save();

        return redirect('projects/');
    }

    public function destroy(Project $project)
    {
     //   $project= Project::find($id);

        //find or fail is used to stop the program if something is not found

        $project->delete();

        return redirect('projects/');

    }


}
