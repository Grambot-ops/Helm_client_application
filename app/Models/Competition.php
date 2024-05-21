<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    protected $fillable = ['competition_type_id', 'user_id'];
    protected $appends = ['closed', 'open', 'vote', 'upload', 'is_liked'];
    protected $guarded = [];

    // this is SEVERELY brain-damaged but I cannot otherwise
    private static $filetypes = [
        'image' => 'Image (jpeg, png, gif)',
        'video' => 'Video (mp4)',
        'audio' => 'Audio (mp3)',
        'document' => 'Documents (pdf, docx, xlsx, pptx, txt)',
        'archive' => 'Archive (zip, tar.gz, 7z, tar.xz)'
    ];

    private static $file_formats = [
        'image' => 'jpeg,jpg,png,gif',
        'video' => 'mp4',
        'audio' => 'mp3',
        'document' => 'pdf,docx,xlsx,pptx,txt',
        'archive' => 'zip,tar.gz,7z,tar.xz',
    ];

    public static function getFileTypes()
    {
        return static::$filetypes;
    }

    public static function fileTypesToFormats(string $_filetypes): string
    {
        $formats = '';
        $exploded = explode(',', $_filetypes);
        foreach($exploded as $filetype) {
            $formats .= static::$file_formats[$filetype];
            if($filetype != array_key_last($exploded))
                $formats .= ',';
        }
        $formats = rtrim($formats, ',');
        return $formats;
    }

    public function getClosedAttribute(): bool
    {
        return $this->attributes['end_date'] < Carbon::now();
    }

    public function getOpenAttribute(): bool
    {
        return $this->attributes['start_date'] > Carbon::now();
    }
    public function getVoteAttribute(): bool
    {
        return $this->attributes['submission_date'] < Carbon::now() && Carbon::now() < $this->attributes['end_date'];
    }

    public function getUploadAttribute(): bool
    {
        return $this->attributes['start_date'] < Carbon::now() && Carbon::now() < $this->attributes['submission_date'];
    }

    // Whether this competition is liked by the current user
    protected function isLiked(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $this->likes()->where('user_id', auth()->user()->id)->exists(),
        );
    }

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
