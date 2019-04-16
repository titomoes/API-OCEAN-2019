<?php

namespace App\Http\Controllers;

use App\Event;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Inscrever em um Evento.
     * @authenticated
     * @queryParam event_id required O id do evento.
     * @queryParam user_id required O id do usuario.
     * @response 200{
     *  "message":"Subscribed"
     * }
     * @response 404{
     *  "erro": "05 = Not find user"
     * }
     * @response 404{
     *  "erro": "06 = Not find event"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function store($event_id, $user_id)
    {
        $event = Event::find($event_id);
        $user = User::find($user_id);
        if ($user && $event) {
            Subscription::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
            ]);
            return response()->json(["message" => "Subscribed"], 200);
        } elseif (!$user) {
            return response()->json(["erro" => "05"], 404);
        } elseif (!$event) {
            return response()->json(["erro" => "06"], 404);
        }
    }
}
