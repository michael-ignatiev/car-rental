<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'model', 'price_per_hour', 'branch_id', 'product_type_id',
    ];
    
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
