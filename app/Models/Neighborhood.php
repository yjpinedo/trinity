<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    // Relationship

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function cells()
    {
        return $this->hasMany(Cell::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
