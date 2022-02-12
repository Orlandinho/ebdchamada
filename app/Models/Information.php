<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'street',
        'neighborhood',
        'city',
        'zipcode',
        'cel',
        'tel'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
