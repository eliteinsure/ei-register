<?php

namespace App\Models;

use App\Models\Claim;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimNote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
