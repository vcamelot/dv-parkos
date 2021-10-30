<?php

namespace App\Http\Controllers;

use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DestinationController extends BaseController
{
    /**
     * List all destinations
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $destinations = Destination::all();
        return $this->SuccessResponse(DestinationResource::collection($destinations));
    }

    /**
     * Show destination details
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $destination = Destination::find($id);
        if (is_null($destination)) {
            return $this->FailureResponse([], 'Destination not found', 404);
        }
        return $this->SuccessResponse(new DestinationResource($destination));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function reservations($id): JsonResponse
    {
        $destination = Destination::find($id);
        if (is_null($destination)) {
            return $this->FailureResponse([], 'Destination not found', 404);
        }
        return $this->SuccessResponse(new DestinationResource($destination, true));

    }
}
