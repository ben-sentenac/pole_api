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
}
