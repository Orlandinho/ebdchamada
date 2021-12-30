<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'name',
        'slug',
        'dob',
        'active',
        'visitor',
        'avatar'
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    //formats date when getting it from the DB
    public function getDob()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['dob'])->format('d/m/Y');
    }

    public function age()
    {
        return now()->diffInYears($this->dob);
    }
}
