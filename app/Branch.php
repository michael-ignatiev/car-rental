<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'city_id', 'is_active'
    ];
    
    public function city()
    {
        return $this->belongsTo('App\City');
    }
    
    public function product() {
        return $this->hasMany('App\Product');
    }
}
