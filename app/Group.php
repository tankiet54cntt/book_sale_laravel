<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table='groups';
    public $timestamps=false;
    // xác định mối quan hệ
    	// 1 group có 1 hoặc nhiều user 
    public function user()
    {
    	return $this->hasMany('App\User','group_id','id');
    }
}
