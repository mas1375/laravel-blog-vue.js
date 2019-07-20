<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table name
    protected $table = 'posts';

    //Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = TRUE ;

    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
