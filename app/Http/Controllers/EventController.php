<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EventController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'date_event' => ['required', 'string', 'max:255', 'unique:events'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $event = Event::find($id);
        if ($event) {
            return response()->json(['event' => $event], 200);
        } else {
            return response()->json([], 404);
        }

    }

    public function update()
    {

    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->delete();
            return response()->json(null, 204);
        } else {
            return response()->json([], 404);
        }

    }
}
