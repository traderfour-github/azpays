<?php

namespace App\Rules;

use App\Models\PurseUser;
use Illuminate\Contracts\Validation\Rule;

class MaxLimitPurseRule implements Rule
{

    private $userId;
    private $purseId;
    private $percentage;
    private $message;

    /**
     * MaxLimitPurseRule constructor.
     * @param $userId
     * @param $purseId
     * @param $percentage
     */
    public function __construct( $userId, $purseId,$percentage)
    {
        $this->userId = $userId;
        $this->purseId = $purseId;
        $this->percentage = $percentage;
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

        if(PurseUser::where(['purse_id'=>$this->purseId,'user_id'=>$this->userId])->first()){
            $this->message = __('messages.respond.duplicate_request');
            return false;
        }
        if($purseUser = PurseUser::where(['user_id'=>auth()->user()->id,'purse_id'=>$this->purseId])->first()){

            $percent = PurseUser::where(['purse_id'=>$purseUser->purse_id])
                ->where('user_id','<>',auth()->user()->id)->sum('percentage');
            if($percent+$this->percentage <= 100){
                return true;
            }else{
                $this->message = __('messages.respond.wrong_purse_access');
                return false;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;

    }
}
