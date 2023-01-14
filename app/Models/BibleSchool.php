<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleSchool extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'teacher_id'];

    // Relationship
    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Member::class, 'teacher_id');
    }
}
