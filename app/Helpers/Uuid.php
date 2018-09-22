<?php

namespace App\Helpers;

class Uuid
{
    
    public static function get()
    {
        
        return md5(microtime() . str_random(8));
    }
}
