<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//this is service container
//app()->singleton('twitter',function()
//{
//   return new \App\Services\Twitter('asdas');
//});

//This is calling service provider
use \App\Services\Twitter;
Route::get('twitter', function (Twitter $twitter) {

    dd($twitter);
});



//This is the original function that was used when no parameter was passed to the views
Route::get('/', function () {

    return view('welcome');
});

Route::get('/contact',function(){
   return view('contact');
});

Route::get('/about',function(){
    return view('about');
});

///We can also pass some data to our views in this way

Route::get('/skills', function () {

    $tasks=[
        'Go to office',
        'Programming',
        'Go home',
    ];
    return view('skills')->with ([
        'tasks'=> $tasks,
        'name' => 'haseeb',
        'degree' =>'Programmer',
        //THis will get the parameters from get request
        'location' => request('location'),
    ]);
});


//For some pages we can use controllers to make our pages dnamic
//These controllers can then return the views for example check this controller in App/http/controller/PagesController

//make the controllers with the command not directly php artisan make;controller controllername





//this is for the get request
//Route::get('/projects','PagesController@index');
//
////this is for the post requests
//Route::post('/projects','PagesController@store');
//
//Route::get('/projects/create','PagesController@create');
//
//Route::get('/projects/{project}/edit','PagesController@edit');
//
//Route::get('/projects/{project}','PagesController@show');
//Route::patch('/projects/{project}','PagesController@update');
//Route::delete('/projects/{project}','PagesController@destroy');




/*
 * There are different kind of route controllers for example
 *
 * Get        /projects         (Get all the data)
 * Get        /projects/create  (Create a new project)
 * Get        /Projects/1       (Get a specific project)
 * Get        /Projects/1/edit       (Edit a project)
 * Post       /projects/save       (Save the data)
 * Patch      /projects/1       means we want to update something from our mode (update)
 *
 * *
 */

//We can use permissions also here with the following code remember the function view is created in the policy

// Route::resource('projects','PagesController')->middleware('can:update,project');
Route::resource('projects','PagesController');

Route::resource('tasks','ProjectTasksController');

Route::post('projects/{project}/tasks','ProjectTasksController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
