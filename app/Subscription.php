<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{



    protected $fillable = ['email', 'name', 'token', 'expired_at', 'is_active'];

    protected $dates = ['expired_at'];

    protected $appends = ['can_access'];

    /**
     * Check if subscriber can access to subscription
     * @return bool
     */
    public function getCanAccessAttribute(){

        return $this->is_active && $this->expired_at >= Carbon::now();
    }

    public function generateToken(){

        $this->token = str_random(64);

        return $this;
    }

    public function setExpiredDate(){

        $this->expired_at = Carbon::now()->addMonths(config('subscriptions.ttl'));

        return $this;
    }

    /**
     * Find subscription by token
     * @param $query
     */
    public function scopeByToken($query, $token){

        return $query->where('token', $token);
    }
}
