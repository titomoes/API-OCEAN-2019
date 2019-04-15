<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['id', 'user_id', 'name', 'lat', 'lng', 'date_event', 'created_at', 'updated_at'];
    protected $table = 'events';

    public function create_user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'event_id', 'id');
    }
}
