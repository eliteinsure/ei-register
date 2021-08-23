<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Claim extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNumberAttribute()
    {
        return 'CL' . $this->created_at->year . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    public function getDayCounterAttribute()
    {
        return $this->created_at->diffInDaysFiltered(function (Carbon $date) {
            return ! $date->isWeekend();
        });
    }
}
