<?php

namespace App\Rules;

use App\RentalPlan;
use App\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class Price implements Rule
{
    protected $request;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rentalPlan = RentalPlan::where(['id' => $this->request['rental_plan_id'], 'is_active'=> 1])->first();
        $product = Product::where(['id' => $this->request['product_id'], 'is_active'=> 1])->first();
        if($rentalPlan && $product){
            return $rentalPlan->hours_quantity * $product->price_per_hour == $value;
        }else{
            return FALSE;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute value is incorrect.';
    }
}
