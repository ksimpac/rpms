<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Meditate\IdentityCard\TaiwanIdentityCard;

class National_ID_No_Check implements Rule
{
    private $National_ID_No;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->National_ID_No = new TaiwanIdentityCard;
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
        return $this->National_ID_No->check($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '身分證輸入錯誤';
    }
}
