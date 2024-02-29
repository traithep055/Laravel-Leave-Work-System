<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    protected $table = 'users';
    protected $fillable = [
        'user_id',
        'role',
        'email',
        'password',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function employee()
    {
        return $this->hasOne(Employees::class, 'user_id', 'user_id');
    }
}

