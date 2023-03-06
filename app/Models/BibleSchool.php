<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleSchool extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'teacher_id'];

    // Relationship
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->withTimestamps();
    }

    public function teacher()
    {
        return $this->belongsTo(Member::class, 'teacher_id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
