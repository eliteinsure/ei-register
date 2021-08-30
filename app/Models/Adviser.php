<?php

namespace App\Models;

use App\Models\Claim;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Adviser extends Model
{
    use HasFactory;
    use HasJsonRelationships;

    protected $guarded = [];

    protected $casts = [
        'requirements' => 'array',
    ];

    public function getStatusClassAttribute()
    {
        return config('services.adviser.status_classes')[$this->status];
    }

    public function getAdviserRequirementsFsprClassAttribute()
    {
        $date = Carbon::parse($this->requirements['adviser_requirements']['fspr']);

        $now = Carbon::now()->startOfDay();

        if ($date >= $now) {
            return 'text-red-600';
        }

        $month = $now->copy()->subMonth()->startOfDay();

        if ($date->between($month, $now)) {
            return 'text-green-600';
        }

        return 'text-shark';
    }

    public function requirementValue($requirementKey, $subRequirementKey, $value)
    {
        $key = config('services.adviser.requirements.' . $requirementKey . '.' . $subRequirementKey);

        if ('expiring-date' == $key['options']) {
            return $value ? Carbon::parse($value)->format('d/m/Y') : null;
        }

        return $value;
    }

    public function requirementClass($requirementKey, $subRequirementKey, $value)
    {
        $key = config('services.adviser.requirements.' . $requirementKey . '.' . $subRequirementKey);

        if (is_array($key['options'])) {
            return $key['classes'][$value] ?? 'text-shark';
        } elseif ('expiring-date' == $key['options']) {
            return $this->{$requirementKey . '_' . $subRequirementKey . '_class'};
        } else {
            return 'text-shark';
        }
    }

    public function adviserComplaints()
    {
        return $this->hasMany(Complaint::class, 'tier->1->adviser_id');
    }

    public function staffComplaints()
    {
        return $this->hasMany(Complaint::class, 'tier->2->staff_id');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}
