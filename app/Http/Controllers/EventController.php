<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EventController extends Controller
{

    protected function validator_create(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'date_event' => ['required', 'date', 'max:255', 'unique:events'],
            'lat' => ['required', 'string', 'max:255'],
            'lng' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);
    }

    protected function validator_update(array $data)
    {
        return Validator::make($data, [
            'name' => ['string', 'max:255'],
            'date_event' => ['date', 'max:255', 'unique:events'],
            'lat' => ['string', 'max:255'],
            'lng' => ['string', 'max:255'],
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

    public function search_name($name)
    {
        $search = Event::where('name', 'like', '%' . $name . '%')->get();
        return $search;
    }

    public function search_day($day)
    {
        $data = ['day' => $day];
        $dayvalidate = Validator::make($data, [
            'day' => 'required|integer|min:1|max:31',
        ]);
        if ($dayvalidate->validate()) {
            $events = Event::all()->filter(function ($value, $key) use ($day) {
                if (Carbon::parse($value['date_event'])->day == $day) {
                    return true;
                }
            });
            if ($events->isNotEmpty()) {
                return response()->json($events, 200);
            } else {
                return response()->json('not found', 404);
            }
        }
    }

    public function search_month($month)
    {
        $data = ['month' => $month];
        $mouthvalidate = Validator::make($data, [
            'month' => 'required|integer|min:1|max:12',
        ]);
        if ($mouthvalidate->validate()) {
            $events = Event::all()->filter(function ($value, $key) use ($month) {
                if (Carbon::parse($value['date_event'])->month == $month) {
                    return true;
                }
            });
            if ($events->isNotEmpty()) {
                return response()->json($events, 200);
            } else {
                return response()->json('not found', 404);
            }
        }
    }

    public function search_year($year)
    {
        $data = ['year' => $year];
        $yearvalidate = Validator::make($data, [
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
        ]);
        if ($yearvalidate->validate()) {
            $events = Event::all()->filter(function ($value, $key) use ($year) {
                if (Carbon::parse($value['date_event'])->year == $year) {
                    return true;
                }
            });
            if ($events->isNotEmpty()) {
                return response()->json($events, 200);
            } else {
                return response()->json('not found', 404);
            }
        }

    }

    public function check($id, $latitude, $longitude, $radius = 2)
    {
        $event = Event::select('events.*')
            ->selectRaw('( 3959 * acos( cos( radians(?) ) *
                           cos( radians( lat ) )
                           * cos( radians( lng ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( lat ) ) )
                         ) AS distance', [$latitude, $longitude, $latitude])
            ->havingRaw("distance < ?", [$radius])
            ->where('id', '=', $id)
            ->get();
        if ($event->isNotEmpty()) {
            return response()->json(['Check-in:' => 'yes'], 200);
        } else {
            return response()->json(['Check-in:' => 'no'], 200);
        }
    }
}
