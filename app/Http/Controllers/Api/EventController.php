<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EventResource;
use App\Http\Traits\LoadRelationShips;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{

    use LoadRelationShips;

    private $relations = ['user','attendees','attendees.user','location'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $query = $this->loadOptionalRelations(Event::query(),$this->relations);


        //return EventResource::controller(Event::with('user)->latest())
        return EventResource::collection($query->latest()->paginate());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create([
            ...$request->validate([
                "name" => "required|string|max:255",
                "description" => "nullable|string",
                "start_time" => "required|date",
                "end_time" => "required|date|after:start_time"
            ]),
            "user_id" => request()->user()->id
        ]);

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Event $event)
    {
        return new EventResource($this->loadOptionalRelations($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {

        $event->update($request->validate([
                "name" => "required|string|max:255",
                "description" => "nullable|string",
                "start_time" => "required|date",
                "end_time" => "required|date|after:start_time"
            ]));

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response(status:204);
    }
}
