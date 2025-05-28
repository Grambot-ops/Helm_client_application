<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'participation_id', // Add competition_id to fillable property
        'delivery_type_id',
        'title',
        'path',
        'link',
        'description',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function participation()
    {
        return $this->belongsTo(Participation::class);
    }

}
