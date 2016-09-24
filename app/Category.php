<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';  // lấy từ bảng categories trên csdl
    public $timestamps=false;  // không sử dụng created_at và updated_at

    //xác định mối quan hệ với các bảng còn lại
    public function book(){
    	return $this->hasMany('App\Book','category_id','id');
    }


}
