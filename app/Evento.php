<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['id', 'name', 'location', 'date_event', 'created_at', 'updated_at'];
    protected $table = ['event'];
}
