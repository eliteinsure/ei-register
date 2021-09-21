<?php

namespace App\Models;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintNote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
