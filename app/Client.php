<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'description'
    ];

    public function projects()
    {
        return $this->hasMany('App\Project', 'client_id');
    }
}
