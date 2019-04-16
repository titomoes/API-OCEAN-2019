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
            'date_event' => ['required', 'date_format:Y-m-d', 'max:255', 'unique:events'],
            'lat' => ['required', 'string', 'max:255'],
            'lng' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);
    }

    protected function validator_update(array $data)
    {
        return Validator::make($data, [
            'name' => ['string', 'max:255'],
            'date_event' => ['date_format:Y-m-d', 'max:255', 'unique:events'],
            'lat' => ['string', 'max:255'],
            'lng' => ['string', 'max:255'],
            'user_id' => ['exists:users,id'],
        ]);
    }

    /**
     * Lista todos os Eventos.
     * @authenticated
     * @response 200{
     *  "id": 3,
     *  "name": "Festa",
     *  "lat": "-3.087147",
     *  "lng": "-60.006116",
     *  "date_event": "2016-04-15",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "user_id": 1
     * }
     * @response 404{
     *  "erro": "01 = No query results"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        if ($events->isNotEmpty()) {
            return response()->json($events, 200);
        } else {
            return response()->json(["erro" => "01"], 404);
        }
    }

    /**
     * Salva o Evento no Banco de Dados.
     * @authenticated
     * @bodyParam name string required O nome do evento.
     * @bodyParam lat string required  A latitude do evento.
     * @bodyParam lng string required A longitude do evento.
     * @bodyParam date_event date required A data que irá ocorrer o evento.
     * @bodyParam user_id int required O id do usuário que criou o evento.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @response 201{
     *  "id": 3,
     *  "name": "Festa",
     *  "lat": "-3.087147",
     *  "lng": "-60.006116",
     *  "date_event": "2016-04-15",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "user_id": 1
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors":[
     *  "name: The name field is required.",
     *  "name: The name may not be greater than 255 characters.",
     *  "date_event: The date_event field is required.",
     *  "date_event: The date event does not match the format Y/m/d.",
     *  "lat: The lat field is required.",
     *  "lat: The lat may not be greater than 255 characters.",
     *  "lng: The lng field is required.",
     *  "lng: The lng may not be greater than 255 characters.",
     *  "user_id: The user_id field is required.",
     *  "user_id: The selected user id is invalid."
     * ]
     * }
     * @response 400{
     * "erro":"02 = No create the object"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     *
     */
    public function store(Request $request)
    {
        $this->validator_create($request->all())->validate();
        $event = Event::create($request->all());
        if ($event) {
            return response()->json(['event' => $event], 201);
        } else {
            return response()->json(['error' => '02'], 400);
        }

    }

    /**
     * Mostra um Evento específico dado o id.
     * @authenticated
     * @queryParam event required O id do evento
     * @response 200{
     *  "id": 3,
     *  "name": "Festa",
     *  "lat": "-3.087147",
     *  "lng": "-60.006116",
     *  "date_event": "2016-04-15",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "user_id": 1
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @response 404{
     *  "erro": "01 = No query results"
     * }
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        if ($event) {
            return response()->json($event, 200);
        } else {
            return response()->json(["erro" => "01"], 404);
        }

    }

    /**
     * Atualiza os dados de um Evento específico.
     * @authenticated
     * @queryParam event required O id do evento
     * @bodyParam name string O nome do evento.
     * @bodyParam lat string A latitude do evento.
     * @bodyParam lng string  A longitude do evento.
     * @bodyParam date_event date A data que irá ocorrer o evento.
     * @bodyParam user_id int O id do usuário que criou o evento.
     * @response 200{
     *  "id": 3,
     *  "name": "Festa",
     *  "lat": "-3.087147",
     *  "lng": "-60.006116",
     *  "date_event": "2016-04-15",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "user_id": 1
     * }
     * @response 404{
     * "erro":"03 = No update the object"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors":[
     *  "name: The name may not be greater than 255 characters.",
     *  "date_event: The date event does not match the format Y/m/d.",
     *  "lat: The lat may not be greater than 255 characters.",
     *  "lng: The lng may not be greater than 255 characters.",
     *  "user_id: The selected user id is invalid."
     * ]
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validator_update($request->all())->validate();
        $event = Event::find($id);
        if ($event) {
            $event->update($request->all());
            return response()->json($event, 200);
        } else {
            return response()->json(["erro" => "03"], 404);
        }

    }

    /**
     * Remove um Evento específico .
     * @authenticated
     * @queryParam event required O id do evento
     * @response 204{
     *  "data": "Event Deleted"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @response 404{
     * "erro":"04 = No delete the object"
     * }
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->delete();
            return response()->json(["data" => "Event deleted"], 204);
        } else {
            return response()->json(["erro" => "04"], 404);
        }

    }

    /**
     * Pesquisa um Evento por nome .
     * @authenticated
     * @queryParam name required O nome do evento em busca
     * @response 200{
     *  "id": 3,
     *  "name": "Festa",
     *  "lat": "-3.087147",
     *  "lng": "-60.006116",
     *  "date_event": "2016-04-15",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "user_id": 1
     * }
     * @response 404{
     *  "erro": "01 = No query results"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors":[
     *  "name: The name may not be greater than 255 characters."
     * ]
     * }
     * @param string $name
     * @return \Illuminate\Http\Response
     */

    public function search_name($name)
    {
        $data = ['name' => $name];
        $namevalidate = Validator::make($data, [
            'name' => 'required|string|max:255',
        ]);
        if ($namevalidate->validate()) {
            $search = Event::where('name', 'like', '%' . $name . '%')->get();
            if ($search->isNotEmpty()) {
                return response()->json($search, 200);
            } else {
                return response()->json(["erro" => "01"], 404);
            }
        }


    }

    /**
     * Pesquisa um Evento por dia .
     * @authenticated
     * @queryParam day required O dia do evento
     * @response 200{
     *  "id": 3,
     *  "name": "Festa",
     *  "lat": "-3.087147",
     *  "lng": "-60.006116",
     *  "date_event": "2016-04-15",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "user_id": 1
     * }
     * @response 404{
     *  "erro": "01 = No query results"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors":[
     *  "day: The day may not be greater than 31 characters.",
     *  "day: The day must be an integer.",
     *  "day: The day must be at least 1."
     * ]
     * }
     * @param int $day
     * @return \Illuminate\Http\Response
     */

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
                return response()->json(["erro" => "01"], 404);
            }
        }
    }

    /**
     * Pesquisa um Evento por mês.
     * @authenticated
     * @queryParam month required O mês do evento
     * @response 200{
     *  "id": 3,
     *  "name": "Festa",
     *  "lat": "-3.087147",
     *  "lng": "-60.006116",
     *  "date_event": "2016-04-15",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "user_id": 1
     * }
     * @response 404{
     *  "erro": "01 = No query results"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors":[
     *  "month: The day may not be greater than 12 characters.",
     *  "month: The day must be an integer.",
     *  "month: The day must be at least 1."
     * ]
     * }
     *
     * @param int $month
     * @return \Illuminate\Http\Response
     */

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
                return response()->json(["erro" => "01"], 404);
            }
        }
    }

    /**
     * Pesquisa um Evento por ano .
     * @authenticated
     * @queryParam year required O ano do evento
     * @response 200{
     *  "id": 3,
     *  "name": "Festa",
     *  "lat": "-3.087147",
     *  "lng": "-60.006116",
     *  "date_event": "2016-04-15",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "user_id": 1
     * }
     * @response 404{
     *  "erro": "01 = No query results"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors":[
     *  "month: The day must be an integer.",
     *  "month: The day must be at least 1900.",
     *  "month: The year must be 4 digits."
     * ]
     * }
     *
     * @param int $year
     * @return \Illuminate\Http\Response
     */
    public function search_year($year)
    {
        $data = ['year' => $year];
        $yearvalidate = Validator::make($data, [
            'year' => 'required|digits:4|integer|min:1900',
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
                return response()->json(["erro" => "01"], 404);
            }
        }

    }

    /**
     * Realiza check-in em Evento por GPS .
     *
     * O check-in é realizado  através da formula de Haversine e para o check-in funcionar tem que estar em um raio de 2km ao redor do evento
     * @authenticated
     * @queryParam id string required O id do evento.
     * @queryParam lat string required A latitude do usuario.
     * @queryParam lng string required A longitude do usuario.
     * @response 200{
     *  "Check-in": "yes"
     * }
     * @response 200{
     *  "Check-in": "no"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @param int $int , string $latitude, $longitude
     * @return \Illuminate\Http\Response
     */
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
