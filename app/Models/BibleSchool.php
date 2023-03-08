<?php

namespace App\Models;

use App\Enums\BibleSchoolProgressEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleSchool extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'teacher_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'progress' => BibleSchoolProgressEnum::class,
    ];

    // Relationship
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->withPivot('progress')->withTimestamps();
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
