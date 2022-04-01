<?php

namespace App\Helpers;

class Auth
{
  public static function connected(){
    return \Cookie::has('id');
  }

}
