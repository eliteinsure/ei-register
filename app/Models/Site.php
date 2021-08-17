<?php

namespace App\Models;

use App\Models\SiteManual;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'launch_date' => 'date:Y-m-d',
        'update_date' => 'date:Y-m-d',
    ];

    public function manuals()
    {
        return $this->hasMany(SiteManual::class);
    }
}
