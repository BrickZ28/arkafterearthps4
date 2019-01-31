<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InvlidEmailAddy implements Rule
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


        return !strpos($value, 'yahoo.com') || strpos($value, 'aol.com') || strpos($value, 'hotmail.com')||strpos($value, 'yahoo.com');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Per the message above you cannot use that email domain';
    }
}
