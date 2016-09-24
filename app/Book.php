<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table='books';

    // xác định mối quan hệ
    // 1 quyển sách chỉ thuộc vào 1 category nào đó
    public function category()
    {
    	return $this->belongsTo('App\Category','category_id','id');
    }
    // 1 quyển sách thì có 1 hoặc nhiều comment
    public function comment()
    {
    	return $this->hasMany('App\Comment','book_id','id');
    }

    // 1 quyển sách có 1 hoặc nhiều tác giả
    public function book_writer()
    {
    	return $this->hasMany('App\Book_Writer','book_id','id');
    }
}
