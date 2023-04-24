<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Mmsi implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //Custom validation rule for Maritime Mobile Service Identity (MMSI) to make sure it follows the correct format
        if (!preg_match('/^MID\d{6}/i', $value)) {
            $fail('The :attribute does not follow the right format - MIDXXXXXX where X is a numeric integer.');
        }
    }
}
