<?php

namespace App\Libraries;


use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PageMeta;
use stdClass;

class Helper
{


    public static function role($user)
    {
        // echo '<pre>'; print_r($user->name); exit;
        $roles = $user->role;

        // foreach($roles as $role)
        // {
        //     return $role->name;
        // }
    }



}
