<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['event_id', 'user_id', 'created_at', 'updated_at'];
    protected $table = 'subscriptions';

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'id', 'event_id');
    }
}
