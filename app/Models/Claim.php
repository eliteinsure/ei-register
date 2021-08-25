<?php

namespace App\Models;

use App\Models\Adviser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Claim extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'type' => 'array',
    ];

    public function getNumberAttribute()
    {
        return 'CL' . $this->created_at->year . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    public function getTypesAttribute()
    {
        return implode(', ', $this->type);
    }

    public function getDayCounterAttribute()
    {
        return $this->created_at->diffInDaysFiltered(function (Carbon $date) {
            return ! $date->isWeekend();
        });
    }

    public function adviser()
    {
        return $this->belongsTo(Adviser::class);
    }
}
