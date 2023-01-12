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

    public function neighborhood()
    {
        $this->belongsTo(Neighborhood::class);
    }

    public function bible_schools()
    {
        return $this->belongsToMany(BibleSchool::class);
    }
}
