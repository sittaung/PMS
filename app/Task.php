<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'subject',
        'project_id',
        'description',
        'status',
        'priority',
        'start_date',
        'due_date',
        'estimated_hours',
        'actual_hours',
        'user_id',
        'registered_user_id'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function assignee()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
