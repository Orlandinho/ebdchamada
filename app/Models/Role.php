<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public const IS_PROFESSOR = 1;
    public const IS_ASSISTENTE = 2;
    public const IS_ADMIN = 3;
}
