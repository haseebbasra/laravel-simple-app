<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title','description','owner_id'
    ];

    //We can also use the guarded variable as the reverse of this one

    protected $guarded = [
        'id'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


    public function addTask($task)
    {

        //method 1
//     return Task::create([
//        'project_id' => $this->id,
//         'description' => $description,
//     ]);

     //another professional way is to use eloquent relations
     //   $this->tasks()->create(['description' => $description]);

        //method 3

        $this->tasks()->create($task);

    }


}
