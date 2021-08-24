<?php

namespace App\Models;

use App\Models\Claim;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Adviser extends Model
{
    use HasFactory;
    use HasJsonRelationships;

    protected $guarded = [];

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
