<?php

namespace App\Http\Controllers;

use App\Jobs\SendPaymentConfirmationEmail;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\JsonResponse;

class ReservationController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $reservations = Reservation::all();

        return $this->SuccessResponse(ReservationResource::collection($reservations));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $reservation = Reservation::find($id);

        if (is_null($reservation)) {
            return $this->FailureResponse([], 'Reservation not found', 404);
        }

        return $this->SuccessResponse(new ReservationResource($reservation));
    }

    /**
     * @param CreateReservationRequest $request
     * @return JsonResponse
     */
    public function store(CreateReservationRequest $request): JsonResponse
    {
        $data = $request->all();

        $reservation = Reservation::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'destination_id' => $data['destination_id'],
            'arrival' => $data['arrival'],
            'departure' => $data['departure'],
            'paid' => 0,
            'status' => 'unpaid'
        ]);

        return $this->SuccessResponse(new ReservationResource($reservation), 'Reservation created', 201);
    }

    /**
     * @param int $id
     * @param UpdateReservationRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UpdateReservationRequest $request): JsonResponse
    {
        $data = $request->all();

        $reservation = Reservation::find($id);

        if (is_null($reservation)) {
            return $this->FailureResponse([], 'Reservation not found', 404);
        }
        if ($reservation->status == 'deleted') {
            return $this->FailureResponse([], 'Canceled reservations cannot be updated');
        }

        $reservation->update($data);

        return $this->SuccessResponse(new ReservationResource($reservation), 'Reservation updated');
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $reservation = Reservation::find($id);

        if (is_null($reservation)) {
            return $this->FailureResponse([], 'Reservation not found', 404);
        }

        $reservation->update(['status' => 'canceled']);
        return $this->SuccessResponse([], 'Reservation deleted', 204);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function pay($id): JsonResponse
    {
        $reservation = Reservation::find($id);

        if (is_null($reservation)) {
            return $this->FailureResponse([], 'Reservation not found', 404);
        }

        $reservation->update([
            'paid' => 1,
            'status' => 'active'
        ]);

        SendPaymentConfirmationEmail::dispatch($reservation);

        return $this->SuccessResponse(new ReservationResource($reservation), 'Reservation paid');
    }

}
