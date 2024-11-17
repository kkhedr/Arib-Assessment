<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class isManagerRule implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {

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
        // If a value is provided, skip further validation
        if (empty($value)) {
            return true;
        }
     
        $user = User::find($value);
        if($user){
            return $user->manager_id === null;
        }
        return false;
    }

        /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'The selected user is not a manager.';
    }
}
