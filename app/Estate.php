<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $dates=['created_at'];
    protected $fillable=['estate_name','estate_price','estate_rent','estate_area','estate_type','estate_small_desc',
        'estate_large_desc','estate_keywords','estate_longitude','estate_latitude','user_id','estate_rooms','estate_status','estate_location'
        ,'estate_price_to','estate_price_from' , 'estate_image'
        ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
}
