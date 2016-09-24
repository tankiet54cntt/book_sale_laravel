<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // xác định mối quan hệ
        // 1 user chỉ thuộc vào 1 group nào đó
    public function group(){

        return $this->belongsTo('App\Group','group_id','id');
    }
    // 1 user có 1 hoặc nhiều comment
    public function comment(){
        return $this->hasMany('App\Comment','user_id','id');
    }

    // 1 user có thể có 1 hoặc nhiều order (cũng có thể 0)
    public function order()
    {
        return $this->hasMany('App\Order','user_id','id');
    }
}
