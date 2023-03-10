<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enums\BibleSchoolProgressEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'document_type',
        'document_number',
        'date_of_birth',
        'sex',
        'civil_state',
        'address',
        'phone',
        'cellphone',
        'is_baptized',
        'user_id',
        'neighborhood_id',
        'cell_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'progress' => BibleSchoolProgressEnum::class,
    ];

    protected $appends = ['age', 'full_name'];

    //Accesors
    public function getAgeAttribute()
    {
        return Carbon::createFromDate($this->date_of_birth)->age;
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->lastname;
    }

    // Relationship
    public function bibleSchools()
    {
        return $this->belongsToMany(BibleSchool::class)->withPivot('progress')->withTimestamps();
    }

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function lead()
    {
        return $this->hasOne(Cell::class, 'leader_id');
    }

    // Relationship
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher()
    {
        return $this->hasMany(BibleSchool::class, 'teacher_id');
    }
}
