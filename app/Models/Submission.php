<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function delivery_type()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function participation()
    {
        return $this->belongsTo(Participation::class);
    }
}
