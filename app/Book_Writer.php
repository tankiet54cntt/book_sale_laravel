<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_Writer extends Model
{
    protected $table='books_writers';
    public $timestamps=false;
    public function book()
    {
    	return $this->belongsTo('App\Book','book_id','id');
    }
    public function writer()
    {
    	return $this->belongsTo('App\Writer','writer_id','id');
    }
}
