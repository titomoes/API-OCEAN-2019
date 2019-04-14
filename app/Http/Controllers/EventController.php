<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EventController extends Controller
{

    protected function validator_create(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'date_event' => ['required', 'date', 'max:255', 'unique:events'],
            'location' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);
    }

    protected function validator_update(array $data)
    {
        return Validator::make($data, [
            'name' => ['string', 'max:255'],
            'date_event' => ['date', 'max:255', 'unique:events'],
            'location' => ['string', 'max:255'],
            'user_id' => ['exists:users,id'],
        ]);
    }

    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        $this->validator_create($request->all())->validate();
        $event = Event::create($request->all());
        if ($event) {
            return response()->json(['event' => $event], 201);
        } else {
            return response()->json(null, 400);
        }

    }

    public function show($id)
    {
        $event = Event::find($id);
        if ($event) {
            return response()->json(['event' => $event], 200);
        } else {
            return response()->json(null, 404);
        }

    }

    public function update(Request $request, $id)
    {
        $this->validator_update($request->all())->validate();
        $event = Event::find($id);
        if ($event) {
            $event->update($request->all());
            return response()->json(['event' => $event], 200);
        } else {
            return response()->json(null, 404);
        }

    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(null, 404);
        }

    }
}
