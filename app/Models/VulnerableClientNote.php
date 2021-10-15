<?php

namespace App\Models;

use App\Models\User;
use App\Models\VulnerableClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VulnerableClientNote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vulnerableClient()
    {
        return $this->belongsTo(VulnerableClient::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
