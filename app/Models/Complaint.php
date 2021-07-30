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

    public function getNumberAttribute()
    {
        return 'CMP' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }

    public function getTierResultAttribute()
    {
        if ('Failed' == $this->tier['1']['result']) {
            return 'Tier 2 - ' . $this->tier['2']['result'];
        }

        return 'Tier 1 - ' . $this->tier['1']['result'];
    }
}
