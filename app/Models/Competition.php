<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    public function changelogs()
    {
        return $this->hasMany(Changelog::class);
    }

    /* organizer */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function noticomps()
    {
        return $this->hasMany(NotiComp::class);
    }

    public function competition_categories()
    {
        return $this->belongsTo(CompetitionCategory::class);
    }

    public function competition_types()
    {
        return $this->belongsTo(CompetitionType::class);
    }
}
