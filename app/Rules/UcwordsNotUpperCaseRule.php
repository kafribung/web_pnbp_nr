<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UcwordsNotUpperCaseRule implements Rule
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
        if ($value == strtoupper($value)) {
            return false;
        }
        return $value == ucwords($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation must be first character of each word to uppercase and .';
    }
}
