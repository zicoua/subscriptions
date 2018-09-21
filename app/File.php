<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = ['name', 'path', 'subscription_id', 'token'];

    public function generateToken(){

        $this->token = str_random(64);

        return $this;
    }

    /**
     * Find file by token
     * @param $query
     */
    public function scopeByToken($query, $token){

        return $query->where('token', $token);
    }
}
