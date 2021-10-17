<?php

namespace App\Models;

use App\Models\VulnerableClientNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VulnerableClient extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'issued_at' => 'date:Y-m-d',
    ];

    public function notes()
    {
        return $this->hasMany(VulnerableClientNote::class);
    }
}
