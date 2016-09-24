<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';

    // xác đinh mối quan hệ
    	// 1 order chỉ thuộc vào 1 user nào dó
    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
}
