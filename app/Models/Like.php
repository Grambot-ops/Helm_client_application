<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
protected $fillable = ['user_id', 'competition_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function scopeSearchName($query, $search = '%')
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('surname', 'like', "%{$search}%");
    }
}
