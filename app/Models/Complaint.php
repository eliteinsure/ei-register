<?php

namespace App\Models;

use App\Models\Adviser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Complaint extends Model
{
    use HasFactory;
    use HasJsonRelationships;

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

    public function adviser()
    {
        return $this->belongsTo(Adviser::class, 'tier->1->adviser_id');
    }
}
