<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Filter implements Rule
{
    protected $forbidden;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($forbidden)
    {
        // one value per rule
        // $this->forbidden =strtolower($forbidden);

        //test arry (more values)
        $this->forbidden= $forbidden;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    { //same Code
        // if(strtolower($value)=='laravel'){
        //     return false;
        // }
        // return true;
        // ----------------------------------------------------------------
        // clean code (same Code)
        //return !(strtolower($value)=='laravel');
        //لو انا بدي امرر الكلامات يلي ممنوع يستخدمها

        //               from request == from object
        // return !(strtolower($value)== $this->forbidden);


        //test arry (more values)
              //    in_array(strtolower($value),$this->forbidden); =>return true
            return ! in_array(strtolower($value),$this->forbidden); //return false

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This name is forbidden!!';
    }
}
