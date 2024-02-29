<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'surname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */

    protected function fullname(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) =>
                sprintf("%s %s", $attributes['name'], $attributes['surname']),
        );
    }
    protected $appends = [
        'profile_photo_url',
        'fullname',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function user_roles()
    {
        return $this->hasMany(UserRole::class);
    }

    public function annoucements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function changelogs()
    {
        return $this->hasMany(Changelog::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }

    public function scopeSearchName($query, $search = '%')
    {
        //Search based on the given name or surname or together
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('surname', 'like', "%{$search}%")
            ->orWhere(DB::raw("CONCAT(`name`,' ',`surname`)"), 'like', "%{$search}%");
    }
}
