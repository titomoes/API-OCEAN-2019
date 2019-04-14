<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['id', 'user_id', 'name', 'location', 'date_event', 'created_at', 'updated_at'];
    protected $table = 'events';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
