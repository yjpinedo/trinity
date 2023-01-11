<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image'];

    // Relationship
    public function neighborhoods ()
    {
        return $this->hasMany(Neighborhood::class);
    }
}