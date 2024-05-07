<?php
//"competition type" should be named "submission type"
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'is_file', 'filetypes'];

    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }
}
