<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'interval_default', 'interval_before_date'];
    public function noticomps()
    {
        return $this->hasMany(NotiComp::class);
    }



}
