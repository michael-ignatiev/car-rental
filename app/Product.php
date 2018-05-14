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
    
    /**
     * Set the price per hour. Convert dollars to cents.
     *
     * @param  string  $value
     * @return void
     */
    public function setPricePerHourAttribute($value)
    {
        $this->attributes['price_per_hour'] = $value * 100;
    }
    
    /**
     * Get the price per hour. Convert cents to dollars.
     *
     * @param  string  $value
     * @return void
     */
    public function getPricePerHourAttribute($value)
    {
        return number_format($value/100, 2, '.', ' ');
    }
}
