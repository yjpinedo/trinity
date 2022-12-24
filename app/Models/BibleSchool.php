<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleSchool extends Model
{
    use HasFactory;

    // Relationship
    public function members()
    {
        return $this->belongsToMany(Member::class);
    }
}
