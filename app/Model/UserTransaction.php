<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    protected  $fillable=['user_id','amount','type','note'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
