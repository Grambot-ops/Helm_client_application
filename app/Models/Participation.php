<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;
    protected $fillable = [
        'competition_id', // Add competition_id to fillable property
        'user_id',
        'ranking',
        'disqualified',
        'application_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
