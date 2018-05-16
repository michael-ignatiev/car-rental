<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Discount;

class Total implements Rule
{
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
     * Check total sum taking in account discount amount.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(isset($this->request['discount_id']))
        {
            $discount = Discount::where(['id' => $this->request['discount_id'], 'is_active' => 1])->first();
            return ((100 - $discount->amount) / 100) * $this->request['price'] == $value;
        }
        else
        {
            return TRUE;
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
