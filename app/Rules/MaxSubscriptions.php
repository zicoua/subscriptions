<?php

namespace App\Rules;

use App\Subscription;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class MaxSubscriptions implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
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

        return Subscription::where($attribute, $value)->count() < config('subscriptions.max_active');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Max subscriptions for this email.';
    }
}
