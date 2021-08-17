<?php

namespace App\Models;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiteManual extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFileExtensionAttribute()
    {
        return Str::afterLast($this->file, '.');
    }

    public function getFilenameAttribute()
    {
        return Str::slug($this->site->name . ' ' . $this->name) . '.' . $this->file_extension;
    }

    public function getFileIconAttribute()
    {
        return config('services.file.icons')[$this->file_extension];
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
