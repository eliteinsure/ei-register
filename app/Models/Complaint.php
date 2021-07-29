<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'received_at' => 'date:Y-m-d',
        'registered_at' => 'date:Y-m-d',
        'acknowledged_at' => 'date:Y-m-d',
        'tier' => 'array',
    ];
}
