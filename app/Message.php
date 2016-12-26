<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sender()
    {
    	return $this->belongsTo('App\User');
    }
    public function recipient()
    {
    	return $this->belongsTo('App\User');
    }
}
