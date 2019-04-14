<?php

namespace App\Http\Controllers;

use App\Event;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store($event_id, $user_id)
    {
        $event = Event::find($event_id);
        $user = User::find($user_id);
        if ($user && $event) {
            Subscription::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
            ]);
            return response()->json('The User: ' . $user->name . " was subscribed on Event: " . $event->name, 200);
        } elseif (!$user) {
            return response()->json('Not found user', 404);
        } elseif (!$event) {
            return response()->json('Not found event', 404);
        }
    }
}
