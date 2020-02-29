<?php
/**
 * Created by PhpStorm.
 * User: mohammadmira
 * Date: 2/29/20
 * Time: 11:46 AM
 */

namespace App\Services\UserService\FindUser;

use App\User;

class FindUser
{
    public function byUsername($username)
    {
        if(is_array($username))
        {
            $emails=[];
            $mobiles=[];
            foreach ($username as $usern)
                if(filter_var($usern, FILTER_VALIDATE_EMAIL))
                    $emails[] = $usern;
                else
                    $mobiles[] = $usern;


            return User::whereIn('email',$emails)->orWhereIn('mobile',$mobiles)->get();
        }
        else
        {
            if(filter_var($username, FILTER_VALIDATE_EMAIL))
                $user=User::whereIn('email',$username)->first();
            else
                $user=User::whereIn('mobile',$username)->first();


            return $user;
        }
    }

}