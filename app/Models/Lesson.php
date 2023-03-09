<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'lesson_date', 'description'];

    // Relationship
    public function bibleSchools()
    {
        return $this->belongsToMany(BibleSchool::class)->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->withTimestamps();
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
