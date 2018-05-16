<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Discount as DiscountModel;

class Discount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return DiscountModel::where(['id' => $value, 'is_active' => 1])->first();
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
