<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected function closed(): Attribute
    {
        return Attribute::make(
        get: fn($value, $attributes) => $attributes['end_date'] < Carbon::now(),
        );
    }

    protected $appends = ['closed'];
    protected $fillable = ['accepted', 'declined'];

    public function changelogs()
    {
        return $this->hasMany(Changelog::class);
    }

    /* organizer */
    public function user()
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

    public function competition_category()
    {
        return $this->belongsTo(CompetitionCategory::class);
    }

    public function competition_type()
    {
        return $this->belongsTo(CompetitionType::class);
    }

    public function scopeSearchTitleOrDescription($query, $search = '%')
    {
        return $query->where('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
    }
}
