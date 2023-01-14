<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function lead()
    {
        return $this->hasOne(Cell::class, 'leader_id');
    }

    public function neighborhood()
    {
        $this->belongsTo(Neighborhood::class);
    }

    public function teacher()
    {
        return $this->hasMany(BibleSchool::class, 'teacher_id');
    }
}
