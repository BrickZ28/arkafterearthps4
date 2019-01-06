<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HasKit implements Rule
{
    protected $levelKit;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($levelKit)
    {
        $this->levelKit = $levelKit;
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


        return $value < $this->levelKit;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Member already received level kit ' . $this->levelKit;
    }
}
