<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'branch_to_take_from_id',
        'branch_to_return_to_id', 'rental_plan_id', 'payment_type_id',
        'payment_status_id', 'price', 'discount_id',
        'total', 'comment'
    ];
    
    /**
     * Set the price. Convert dollars to cents.
     *
     * @param  string  $value
     * @return void
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }
    
    /**
     * Get the price. Convert cents to dollars.
     *
     * @param  string  $value
     * @return void
     */
    public function getPriceAttribute($value)
    {
        return number_format($value/100, 2, '.', ' ');
    }
    
    /**
     * Set the price. Convert dollars to cents.
     *
     * @param  string  $value
     * @return void
     */
    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = $value * 100;
    }
    
    /**
     * Get the price. Convert cents to dollars.
     *
     * @param  string  $value
     * @return void
     */
    public function getTotalAttribute($value)
    {
        return number_format($value/100, 2, '.', ' ');
    }
}
