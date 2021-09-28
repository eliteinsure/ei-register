<?php

namespace App\Models;

use App\Models\Adviser;
use App\Models\ComplaintNote;
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
        'acknowledged_at' => 'date:Y-m-d',
        'tier' => 'array',
    ];

    public function getNumberAttribute()
    {
        return 'CMP' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }

    public function getStatusAttribute()
    {
        return 'Tier ' . $this->tier['tier'] . ' - ' . $this->tier['status'];
    }

    public function getDayCounterAttribute()
    {
        if ('Resolved' == ($this->tier['status'] ?? '')) {
            $counter = $this->acknowledged_at->diffInDaysFiltered(function (Carbon $date) {
                return ! $date->isWeekend();
            }, isset($this->tier['completed_at']) ? Carbon::parse($this->tier['completed_at']) : null) - 1;

            return $counter < 0 ? 0 : $counter;
        }

        $counter = $this->acknowledged_at->diffInDaysFiltered(function (Carbon $date) {
            return ! $date->isWeekend();
        }) - 1;

        return $counter < 0 ? 0 : $counter;
    }

    public function adviser()
    {
        return $this->belongsTo(Adviser::class, 'tier->adviser_id');
    }

    public function notes()
    {
        return $this->hasMany(ComplaintNote::class);
    }
}
