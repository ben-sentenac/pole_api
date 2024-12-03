<?php

namespace App\Http\Controllers\Api;

use App\Http\Traits\LoadRelationShips;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;

class AttendeeController extends Controller
{

    use LoadRelationShips;

    private $relations = ['user'];
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $attendees = $this->loadOptionalRelations($event->attendees()->latest());

        return AttendeeResource::collection( $attendees->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Event $event)
    {
        $attendee = $event->attendees()->create([
            'user_id'=>request()->user()->id,
        ]);

        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Attendee $attendee)
    {
        //
        $attendee->delete();
        return response(status:204);
    }
}
