<?php
//"competition type" should be named "submission type"
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'is_file', 'filetypes'];

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
        foreach(explode(',', $_filetypes) as $filetype) {
            $formats .= static::$file_formats[$filetype];
        }
        $formats = rtrim($formats, ',');
        return $formats;
    }
    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }
}
