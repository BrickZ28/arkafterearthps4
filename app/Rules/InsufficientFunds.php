<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InsufficientFunds implements Rule
{
    protected $funds;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($funds)
    {
         $this->funds = $funds;
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
        return $value < $this->funds;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Insufficient Funds for Transaction';
    }
}
