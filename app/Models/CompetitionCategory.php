<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }
}
