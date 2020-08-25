<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitesetting extends Model
{
    protected $fillable = ['slug','settingName','value','type'];
    protected $dates = ['created_at'];

}
