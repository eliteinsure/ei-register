<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteManual extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getUrlAttribute()
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
