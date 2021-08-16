<?php

namespace App\Models;

use App\Models\Adviser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
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

    public function getStatusAttribute()
    {
        if ('Failed' == $this->tier['1']['status']) {
            return 'Tier 2 - ' . $this->tier['2']['status'];
        }

        if ('Pending' == $this->tier['1']['status']) {
            return $this->tier['1']['status'];
        }

        return 'Tier 1 - ' . $this->tier['1']['status'];
    }

    public function getDayCounterAttribute()
    {
        if ('Success' == ($this->tier['1']['status'] ?? '')) {
            return $this->acknowledged_at->diffInDaysFiltered(function (Carbon $date) {
                return ! $date->isWeekend();
            }, Carbon::parse($this->tier['1']['stated_at']));
        }

        if ('Success' == ($this->tier['2']['status'] ?? '')) {
            return $this->acknowledged_at->diffInDaysFiltered(function (Carbon $date) {
                return ! $date->isWeekend();
            }, Carbon::parse($this->tier['2']['handed_over_at']));
        }

        return $this->acknowledged_at->diffInDaysFiltered(function (Carbon $date) {
            return ! $date->isWeekend();
        });
    }

    public function adviser()
    {
        return $this->belongsTo(Adviser::class, 'tier->1->adviser_id');
    }
}
