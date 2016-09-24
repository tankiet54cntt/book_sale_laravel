<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $table='writers';

    public $timestamps=false;  // không sử dụng created_at và updated_at
    // mối quan hệ
    public function book()
    {
    	return $this->hasManyThrough('App\Book_Writer','App\Book','writer_id','book_id','id');
    }
    // 1 tác giả viết 1 hoặc nhiều sách
    public function book_writer()
    {
    	return $this->hasMany('App\Book_Writer','writer_id','id');
    }

}
