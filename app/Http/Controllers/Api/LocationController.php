<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\LoadRelationShips;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    use LoadRelationShips;

    private $relations = ['events'];
    //
    public function index() {
        $events = $this->loadOptionalRelations(Location::query(), $this->relations);
       return LocationResource::collection($events->latest()->paginate());
    }

    public function show (Request $request,Location $location) {
        return new LocationResource($this->loadOptionalRelations($location));
    }

    public function store(Request $request) {
        $location = Location::create([
            ...$request->validate([
                "name" => 'required|string',
                "address" => 'required|string',
                'coordinates' => 'nullable|json'
            ])
        ]);
        return new LocationResource($location);
    }
}
