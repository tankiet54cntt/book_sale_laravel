<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';

    // xác định mqh
    	// 1 comment chỉ thuộc vào 1 quyển sách nào đó
    public function book()
    {
    	return $this->belongsTo('App\Book','book_id','id');
    }
    	// 1 comment chỉ thuộc vào 1 user nào đó
    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
}
