<?php

namespace Qafeen\Aadhaar;

use Illuminate\Support\Facades\Facade;

class AadhaarFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'aadhaar';
    }
}
