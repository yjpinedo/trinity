<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    // Relationship
    public function leader()
    {
        return $this->belongsTo(Member::class, 'leader_id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
