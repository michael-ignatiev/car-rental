<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    public function roles()
    {
        return $this->belongsToMany('App\UserRole');
    }
}
