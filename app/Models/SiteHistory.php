<?php

namespace App\Models;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'update_date' => 'date:Y-m-d',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
