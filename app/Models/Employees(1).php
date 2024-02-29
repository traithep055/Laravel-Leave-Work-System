<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{

    use HasFactory;

    protected $primaryKey = 'emp_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['emp_id', 'first_name', 'last_name', 'dob', 'contact_number', 'address', 'user_id'];
    protected $table = 'employees';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function jobDetail()
    {
        return $this->hasOne(Job_details::class, 'emp_id', 'emp_id');
    }



}
