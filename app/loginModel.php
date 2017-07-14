<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loginModel extends Model
{
    //
    protected $table = 'loginJWT';
    public $incrementing = false;
    protected $primaryKey = 'email';
    protected $guarded = ['updated_at','created_at'];
}
