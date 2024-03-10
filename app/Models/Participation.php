<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submissions()
    {
        $this->hasMany(Submission::class);
    }

    public function competition()
    {
        $this->belongsTo(Competition::class);
    }
}
