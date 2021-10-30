<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'destination_id',
        'arrival',
        'departure',
        'paid',
        'status'
    ];

    public function destination() {
        return $this->hasOne(Destination::class, 'id', 'destination_id');
    }
}
