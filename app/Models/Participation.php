<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(Competition::class);
    }

    public function submissions()
    {
        $this->hasMany(Submission::class);
    }

    public function competitions()
    {
        $this->belongsTo(Competition::class);
    }
}
