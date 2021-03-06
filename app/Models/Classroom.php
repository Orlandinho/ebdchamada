<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'class',
        'slug',
        'description'
    ];

    protected $with = ['students'];

    public function students()
    {
        return $this->hasMany(Student::class)->orderBy('name');
    }

    public function teachers()
    {
        return $this->hasMany(User::class);
    }
}
